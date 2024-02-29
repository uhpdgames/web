from tqdm import tqdm
import asyncio
import aiohttp
import os
import pandas as pd
from oauth2client.service_account import ServiceAccountCredentials
import json

# Constants
SCOPES = ["https://www.googleapis.com/auth/indexing"]
ENDPOINT = "https://indexing.googleapis.com/v3/urlNotifications:publish"
URLS_PER_ACCOUNT = 200

from aiohttp.client_exceptions import ServerDisconnectedError

async def send_url(session, http, url):
    content = {
        'url': url.strip(),
        'type': "URL_UPDATED"
    }
    for _ in range(3):  # Retry up to 3 times
        try:
            async with session.post(ENDPOINT, json=content, headers={"Authorization": f"Bearer {http}"}, ssl=False) as response:
                return await response.text()
        except ServerDisconnectedError:
            await asyncio.sleep(2)  # Wait for 2 seconds before retrying
            continue
    return '{"error": {"code": 500, "message": "Server Disconnected after multiple retries"}}'  # Return a custom error message after all retries fail

async def indexURL(http, urls):
    successful_urls = 0
    error_429_count = 0
    other_errors_count = 0
    tasks = []

    async with aiohttp.ClientSession() as session:
        # Using tqdm for progress bar
        for url in tqdm(urls, desc="Processing URLs", unit="url"):
            tasks.append(send_url(session, http, url))

        results = await asyncio.gather(*tasks)

        for result in results:
            data = json.loads(result)
            if "error" in data:
                if data["error"]["code"] == 429:
                    error_429_count += 1
                else:
                    other_errors_count += 1
            else:
                successful_urls += 1

    print(f"\nTỔNG SỐ LINK ĐÃ GỬI YÊU CẦU: {len(urls)}")
    #print(f"SỐ LƯỢNG THÀNH CÔNG: {successful_urls}")
    print(f"TỔNG GỬI THẤT BẠI: {error_429_count}")

def setup_http_client(json_key_file):
    credentials = ServiceAccountCredentials.from_json_keyfile_name(json_key_file, scopes=SCOPES)
    token = credentials.get_access_token().access_token
    return token

def main():
    # Check if CSV file exists
    if not os.path.exists("data.csv"):
        print("Error: data.csv file not found!")
        return

    # Ask user for number of accounts
    num_accounts = int(input("SỐ LƯỢNG TÀI KHOẢN QUÉT? "))
    if not 1 <= num_accounts <= 5:
        print("Invalid number of accounts. Please enter a number between 1 and 5.")
        return

    # Read all URLs from CSV
    try:
        all_urls = pd.read_csv("data.csv")["URL"].tolist()
    except Exception as e:
        print(f"Error reading data.csv: {e}")
        return

    # Process URLs for each account
    for i in range(num_accounts):
        print(f"\nĐANG XỬ LÝ... {i+1}...")
        json_key_file = f"account{i+1}.json"

        # Check if account JSON file exists
        if not os.path.exists(json_key_file):
            print(f"Error: {json_key_file} not found!")
            continue

        start_index = i * URLS_PER_ACCOUNT
        end_index = start_index + URLS_PER_ACCOUNT
        urls_for_account = all_urls[start_index:end_index]
        
        http = setup_http_client(json_key_file)
        asyncio.run(indexURL(http, urls_for_account))

# Call the main function
if __name__ == "__main__":
    try:
        main()
    except KeyboardInterrupt:
        print("\nScript paused. Press Enter to resume or Ctrl+C again to exit.")
        input()
        main()
