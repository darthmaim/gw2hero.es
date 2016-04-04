"use strict";

var version = '2016-04-04';

var offlinePage = '{{ action('MiscController@getOffline') }}';

var assets = [
    offlinePage,
    '{{ asset2('css/gw2heroes.css') }}',
    '{{ asset2('css/normalize.css') }}',
    '{{ asset2('images/icons.svg') }}',
    '{{ asset2('images/background.png') }}',
    '{{ asset2('images/header.svg') }}',
    '{{ asset2('js/gw2heroes.js') }}'
];

var cacheName = 'gw2heroes:' + version;

self.addEventListener('install', function(event) {
    event.waitUntil(
        caches.open(cacheName).then(function(cache) {
            return cache.addAll(assets)
        })
    );
});

self.addEventListener('fetch', function(event) {
    if (event.request.method !== 'GET') {
        return;
    }

    // always fetch first, then try cache, then show offline
    var response = fetch(event.request).catch(function() {
        return caches.match(event.request).then(function(cached) {
            return cached || caches.match(offlinePage);
        });
    });

    event.respondWith(response);
});


self.addEventListener('activate', function(event) {
    event.waitUntil(
        caches.keys().then(function (keys) {
            return Promise.all(
                keys.filter(function (key) {
                    return !key.endsWith(version);
                }).map(function (key) {
                    return caches.delete(key);
                })
            );
        })
    );
});
