/*=============================================================================
// UHPD_Core.js - v1.0
// ----------------------------------------------------------------------------
// Copyright (c) 2019 UHPD Games
// This software is released under the MIT License.
// http://opensource.org/licenses/mit-license.php
// ----------------------------------------------------------------------------
// [Page games]: http://uhpdgames.itch.io/
// [Page motoVBlog]: https://ixdbiker.motorcycles/
// [GitHub] : https://github.com/uhpdgames/
// [Contact]: kenji.vn14@gmail.com || uhpdgames@gmail.com
*=============================================================================*/


/*https://www.youtube.com/watch?v=8K2ihr3NC40*/

class UHPD {

    constructor(...args) {
        this.initialize(...args);
        this._start = false;
        this._loading = false;
    }

    initialize() {
        this.clear();
        this.CheckWebsiteIsReady();
    }

    CheckWebsiteIsReady(){
        if(document.readyState === "complete") {
            this._start = true;
            this._loading = false;
        }
        else if(document.readyState === "interactive") {
            this._start = false;
            this._loading = true;
        }
        else {
            // Loading still in progress.
            // To wait for it to complete, add "DOMContentLoaded" or "load" listeners.

            window.addEventListener("DOMContentLoaded", () => {
                // DOM ready! Images, frames, and other subresources are still downloading.
                this._loading = true;
            });

            window.addEventListener("load", () => {
                // Fully loaded!
                this._start = true;
                this._loading = false;
            });
        }
    }
    websiteIsReady(){
        return this._start;
    }


    create() {
    }

    clear() {

    }

    setupEV() {
        this._EV = new Map();
    }

    setEV(key, value) {
        this._EV.set(key, value);
        // return this;
    }

    getEV(key) {
        return this._EV.get(key);
    }

    deleteEV(key) {
        this._EV.delete(key);
    }

    clearEV() {
        this._EV.clear();
    }


    checkEV(key) {
        return !!this._EV.has(key);
    }

    static async PromiseEach(arr, fn) {
        for (const item of arr) await fn(item);
    }

    static delay(delay) {
        return this.sleep(delay);
    }
    static decode(str) {

        let txt = new DOMParser().parseFromString(str, "text/html");

        return txt.documentElement.textContent;

    }
    static ReadFile(obj) {
        const {url, method, override, type, params, async} = obj;
        return new Promise(function (resolve, reject) {
            const xhr = new XMLHttpRequest();
            xhr.responseType = type || '';
            if (override !== undefined) {
                xhr.overrideMimeType(override);
            }
            xhr.onreadystatechange = () => {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        resolve(xhr.responseText);
                    }
                    else {
                        reject(xhr);
                    }
                }
            };
            xhr.open(method || 'GET', url, async || false);
            xhr.send(params || null);
        });
    }


    static imgLoad(url) {
        'use strict';
        // Create new promise with the Promise() constructor;
        // This has as its argument a function with two parameters, resolve and reject
        return new Promise(function (resolve, reject) {
            // Standard XHR to load an image
            var request = new XMLHttpRequest();
            request.open('GET', url);
            request.responseType = 'blob';

            // When the request loads, check whether it was successful
            request.onload = function () {
                if (request.status === 200) {
                    // If successful, resolve the promise by passing back the request response
                    resolve(request.response);
                } else {
                    // If it fails, reject the promise with a error message
                    reject(new Error('Image didn\'t load successfully; error code:' + request.statusText));
                }
            };

            request.onerror = function () {
                // Also deal with the case when the entire request fails to begin with
                // This is probably a network error, so reject the promise with an appropriate message
                reject(new Error('There was a network error.'));
            };

            // Send the request
            request.send();
        });
    }


    static loadImage() {
        'use strict';
        // Get a reference to the body element, and create a new image object
        var body = document.querySelector('body'),
            myImage = new Image();

        myImage.crossOrigin = ""; // or "anonymous"

        // Call the function with the URL we want to load, but then chain the
        // promise then() method on to the end of it. This contains two callbacks
        UHPD.imgLoad('http://i.imgur.com/YzkSFCW.png').then(function (response) {
            // The first runs when the promise resolves, with the request.reponse specified within the resolve() method.
            var imageURL = window.URL.createObjectURL(response);
            myImage.src = imageURL;
            body.appendChild(myImage);
            // The second runs when the promise is rejected, and logs the Error specified with the reject() method.
        }, function (Error) {
            console.log(Error);
        });
    }

    static sleep(milliseconds) {
        return new Promise(resolve => setTimeout(resolve, milliseconds))
    }

    static parameter() {
        return {}
    }

    static load_css(url) {
        let link = document.createElement('link');
        link.rel = 'stylesheet';
        link.type = 'text/css';
        link.href = `assets/css/${url}.css`;
        document.body.appendChild(link)
    }
	static load_html($type) {
/*

        var http = new XMLHttpRequest();
        var url = 'get_data.php';
        var params = 'orem=ipsum&name=binny';
        http.open('POST', url, true);
*/

		UHPD.ReadFile({
			async:false,
           // params:`?type=${$type}`,
			method: 'GET',
			url: `${site_url()}ajax/html?type=${$type}`,
			override: 'text/xml',
		})
			.then(data=>{
console.log(data)
			});

/*		$.ajax({
			type: "POST",
			url: site_url() + `ajax/html`,
			dataType: 'html',
			data: {type: $type},
			success: function (result) {
				if (result) {
					const array = $type.split(',');
					$text = jQuery.parseJSON(result);
					for (const id of array) {
						let tag = '#';
						// if (id.includes('banner_')) tag = '#';
						const ele = tag + id;
						if ($(ele).length) $(ele).html(decode($text[id]));
					}
				}


			},
			complete: function () {
				InitWhereLoadHTML();
			}
		});*/
	}

}
/*
AOS Library T
Push.js Tutorial | Create Desktop Notification with Javascript
Barba.js 

SweetAlert Tutorial - Make a Cool Javascript Popup
Fullpage.js Tutorial - Part 1: Introduction



php ... LOAD ALL IMG =>  LZ BASE => JS DECODE LZ BASE => ADD PREVIEW
*/



const needUpdatedData = ()=>{
    const listMap = [
        'Map002', 'Map003', 'Map009', 'Map024', 'Map025', 'Map026', 'Map028',
        'QMap003', 'QMap009', 'QMap024', 'Map025', 'QMap026'
    ];

    for (const map of listMap) {
        const key = `${map}.json`;

        UHPD.ReadFile({url: `data/${key}`, override: 'application/json'})
            .then(data => {
                DataManager.extractMetadata(data);
                for (let ev of data.events) {
                    if (ev && ev.note !== undefined) {
                        this.extractMetadata(ev);
                    }
                }

                if (!($uhpd.checkEV(key))) $uhpd.setEV(key, data);
            });
    }
};
