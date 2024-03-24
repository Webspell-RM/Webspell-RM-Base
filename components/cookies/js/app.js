const im = iframemanager();
const MAPS_API_KEY = ''

im.run({

    onChange: ({changedServices, eventSource}) => {
        console.log(changedServices, eventSource)
    },

    //currLang: 'en',
     autoLang: true,

    services : {

        youtube : {
            category: 'analytics',
            embedUrl: 'https://www.youtube-nocookie.com/embed/{data-id}',
            thumbnailUrl: 'https://i3.ytimg.com/vi/{data-id}/hqdefault.jpg',
            iframe : {
                //allow : 'accelerometer; encrypted-media; gyroscope; picture-in-picture; fullscreen;',
                allow : '',
            },

            languages : {
                en : {
                    notice: 'This content is hosted by a third party. By showing the external content you accept the <a rel="noreferrer noopener" href="https://www.youtube.com/t/terms" target="_blank">terms and conditions</a> of youtube.com.',
                    loadBtn: 'Load once',
                    loadAllBtn: "Don't ask again"
                },
				
				de : {
                    notice: 'Dieser Inhalt wird von einem Dritten gehostet. Durch das Anzeigen der externen Inhalte akzeptieren Sie die <a rel="noreferrer noopener" href="https://www.youtube.com/t/terms" target="_blank">Allgemeine Geschäftsbedingungen</a> von youtube.com.',
                    loadBtn: 'Einmal laden',
                    loadAllBtn: "Fragen Sie nicht noch einmal"
                },
				
				it : {
                    notice: 'Questo contenuto è ospitato da una terza parte. Mostrando il contenuto esterno accetti i <a rel="noreferrer noopener" href="https://www.youtube.com/t/terms" target="_blank">termini e condizioni</a> di youtube.com.',
                    loadBtn: 'Consenti una volta',
                    loadAllBtn: "Consenti sempre"
                }
            }
        },

        dailymotion : {
            embedUrl: 'https://www.dailymotion.com/embed/video/{data-id}',

            // Use dailymotion api to obtain thumbnail
            thumbnailUrl: async (id, setThumbnail) => {
                const url = `https://api.dailymotion.com/video/${id}?fields=thumbnail_large_url`;
                const response = await (await fetch(url)).json();
                const thumbnailUrl = response.thumbnail_large_url;
                thumbnailUrl && setThumbnail(thumbnailUrl);
            },

            iframe : {
                //allow : 'accelerometer; encrypted-media; gyroscope; picture-in-picture; fullscreen;'
                allow : '',
            },

            languages : {
                en : {
                    notice: 'This content is hosted by a third party. By showing the external content you accept the <a rel="noreferrer noopener" href="https://legal.dailymotion.com/en/terms-of-use/" target="_blank">terms and conditions</a> of dailymotion.com.',
                    loadBtn: 'Load once',
                    loadAllBtn: "Don't ask again"
                },
				
				de : {
                    notice: 'Dieser Inhalt wird von einem Dritten gehostet. Durch das Anzeigen der externen Inhalte akzeptieren Sie die <a rel="noreferrer noopener" href="https://legal.dailymotion.com/en/terms-of-use/" target="_blank">Allgemeine Geschäftsbedingungen</a> von dailymotion.com.',
                    loadBtn: 'Einmal laden',
                    loadAllBtn: "Fragen Sie nicht noch einmal"
                },
				
				it : {
                    notice: 'Questo contenuto è ospitato da una terza parte. Mostrando il contenuto esterno accetti i <a rel="noreferrer noopener" href="https://legal.dailymotion.com/en/terms-of-use/" target="_blank">termini e condizioni</a> di dailymotion.com.',
                    loadBtn: 'Consenti una volta',
                    loadAllBtn: "Consenti sempre"
                }
            }
        },

        twitch : {
            embedUrl: `https://player.twitch.tv/?{data-id}&parent=${location.hostname}`,

            iframe : {
                //allow : 'accelerometer; encrypted-media; gyroscope; picture-in-picture; fullscreen;',
                allow : '',
            },

            languages : {
                en : {
                    notice: 'This content is hosted by a third party. By showing the external content you accept the <a rel="noreferrer noopener" href="https://www.twitch.tv/p/en/legal/cookie-notice/" target="_blank">terms and conditions</a> of twitch.com.',
                    loadBtn: 'Load once',
                    loadAllBtn: "Don't ask again"
                },
				
				de : {
                    notice: 'Dieser Inhalt wird von einem Dritten gehostet. Durch das Anzeigen der externen Inhalte akzeptieren Sie die <a rel="noreferrer noopener" href="https://www.twitch.tv/p/de-de/legal/cookie-notice/" target="_blank">Allgemeine Geschäftsbedingungen</a> von twitch.com.',
                    loadBtn: 'Einmal laden',
                    loadAllBtn: "Fragen Sie nicht noch einmal"
                },
				
				it : {
                    notice: 'Questo contenuto è ospitato da una terza parte. Mostrando il contenuto esterno accetti i <a rel="noreferrer noopener" href="https://www.twitch.tv/p/it-it/legal/cookie-notice/" target="_blank">termini e condizioni</a> di twitch.com.',
                    loadBtn: 'Consenti una volta',
                    loadAllBtn: "Consenti sempre"
                }
            }
        },

        server : {
            //embedUrl: `https://cache.gametracker.com/server_info/{data-id}/b_560_95_1.png`,
            embedUrl: `https://cache.gametracker.com/components/html0/?host={data-id}&bgColor=333333&fontColor=cccccc&titleBgColor=222222&titleColor=ff9900&borderColor=555555&linkColor=ffcc00&borderLinkColor=222222&showMap=1&currentPlayersHeight=100&showCurrPlayers=1&topPlayersHeight=100&showTopPlayers=1&showBlogs=0&width=280`,
            
            
            iframe : {
                //allow : 'accelerometer; encrypted-media; gyroscope; picture-in-picture; fullscreen;',
                //allow : 'picture-in-picture; fullscreen;',
                allow : '',
            },

            languages : {
                en : {
                    notice: 'This content is hosted by a third party. By showing the external content you accept the <a rel="noreferrer noopener" href="https://www.gametracker.com/legal/cookie_policy/" target="_blank">terms and conditions</a> of gametracker.com.',
                    loadBtn: 'Load once',
                    loadAllBtn: "Don't ask again"
                },
				
				de : {
                    notice: 'Dieser Inhalt wird von einem Dritten gehostet. Durch das Anzeigen der externen Inhalte akzeptieren Sie die <a rel="noreferrer noopener" href="https://www.gametracker.com/legal/cookie_policy/" target="_blank">Allgemeine Geschäftsbedingungen</a> von gametracker.com.',
                    loadBtn: 'Einmal laden',
                    loadAllBtn: "Fragen Sie nicht noch einmal"
                },
				
				it : {
                    notice: 'Questo contenuto è ospitato da una terza parte. Mostrando il contenuto esterno accetti i <a rel="noreferrer noopener" href="https://www.gametracker.com/legal/cookie_policy/" target="_blank">termini e condizioni</a> di gametracker.com.',
                    loadBtn: 'Consenti una volta',
                    loadAllBtn: "Consenti sempre"
                }
            }
        },

        discord : {
            embedUrl: `https://discordapp.com/widget?id={data-id}`,

            iframe : {
                //allow : 'accelerometer; encrypted-media; gyroscope; picture-in-picture; fullscreen;',
                allow : '',
            },

            languages : {
                en : {
                    notice: 'This content is hosted by a third party. By showing the external content you accept the <a rel="noreferrer noopener" href="https://discord.com/privacy" target="_blank">terms and conditions</a> of discordapp.com.',
                    loadBtn: 'Load once',
                    loadAllBtn: "Don't ask again"
                },
				
				de : {
                    notice: 'Dieser Inhalt wird von einem Dritten gehostet. Durch das Anzeigen der externen Inhalte akzeptieren Sie die <a rel="noreferrer noopener" href="https://discord.com/privacy" target="_blank">Allgemeine Geschäftsbedingungen</a> von discordapp.com.',
                    loadBtn: 'Einmal laden',
                    loadAllBtn: "Fragen Sie nicht noch einmal"
                },
				
				it : {
                    notice: 'Questo contenuto è ospitato da una terza parte. Mostrando il contenuto esterno accetti i <a rel="noreferrer noopener" href="https://discord.com/privacy" target="_blank">termini e condizioni</a> di discordapp.com.',
                    loadBtn: 'Consenti una volta',
                    loadAllBtn: "Consenti sempre"
                }
            }
        },

        discord_content : {
            embedUrl: `https://discordapp.com/widget?id={data-id}`,

            iframe : {
                //allow : 'accelerometer; encrypted-media; gyroscope; picture-in-picture; fullscreen;',
                allow : '',
            },

            languages : {
                en : {
                    notice: 'This content is hosted by a third party. By showing the external content you accept the <a rel="noreferrer noopener" href="https://discord.com/privacy" target="_blank">terms and conditions</a> of discordapp.com.',
                    loadBtn: 'Load once',
                    loadAllBtn: "Don't ask again"
                },
				
				de : {
                    notice: 'Dieser Inhalt wird von einem Dritten gehostet. Durch das Anzeigen der externen Inhalte akzeptieren Sie die <a rel="noreferrer noopener" href="https://discord.com/privacy" target="_blank">Allgemeine Geschäftsbedingungen</a> von discordapp.com.',
                    loadBtn: 'Einmal laden',
                    loadAllBtn: "Fragen Sie nicht noch einmal"
                },
				
				it : {
                    notice: 'Questo contenuto è ospitato da una terza parte. Mostrando il contenuto esterno accetti i <a rel="noreferrer noopener" href="https://discord.com/privacy" target="_blank">termini e condizioni</a> di discordapp.com.',
                    loadBtn: 'Consenti una volta',
                    loadAllBtn: "Consenti sempre"
                }
            }
        },

        gametracker : {
            embedUrl: `https://cache.gametracker.com/components/html0/?host={data-id}&bgColor=333333&fontColor=cccccc&titleBgColor=222222&titleColor=ff9900&borderColor=555555&linkColor=ffcc00&borderLinkColor=222222&showMap=1&currentPlayersHeight=100&showCurrPlayers=1&topPlayersHeight=100&showTopPlayers=1&showBlogs=0&width=280`,
            //thumbnailUrl: '/includes/plugins/gametracker_server/images/gametracker_server_offline.jpg',
            
            iframe : {
                //allow : 'accelerometer; encrypted-media; gyroscope; picture-in-picture; fullscreen;',
                //allow : 'picture-in-picture; fullscreen;',
                allow : '',
            },

            languages : {
                en : {
                    notice: 'This content is hosted by a third party. By showing the external content you accept the <a rel="noreferrer noopener" href="https://www.gametracker.com/legal/cookie_policy/" target="_blank">terms and conditions</a> of gametracker.com.',
                    loadBtn: 'Load once',
                    loadAllBtn: "Don't ask again"
                },
				
				de : {
                    notice: 'Dieser Inhalt wird von einem Dritten gehostet. Durch das Anzeigen der externen Inhalte akzeptieren Sie die <a rel="noreferrer noopener" href="https://www.gametracker.com/legal/cookie_policy/" target="_blank">Allgemeine Geschäftsbedingungen</a> von gametracker.com.',
                    loadBtn: 'Einmal laden',
                    loadAllBtn: "Fragen Sie nicht noch einmal"
                },
				
				it : {
                    notice: 'Questo contenuto è ospitato da una terza parte. Mostrando il contenuto esterno accetti i <a rel="noreferrer noopener" href="https://www.gametracker.com/legal/cookie_policy/" target="_blank">termini e condizioni</a> di gametracker.com.',
                    loadBtn: 'Consenti una volta',
                    loadAllBtn: "Consenti sempre"
                }
            }
        },

        /*leaflet: {
            /**
             *
             * @param {HTMLDivElement} div
             */
            /*onAccept: async (div, setIframe) => {
                const leafletLoaded = await loadScript('https://unpkg.com/leaflet@1.9.3/dist/leaflet.js');
                const leafletReady = leafletLoaded && await im.childExists({childProperty: 'L'});

                if(!leafletReady)
                    return;

                const mapCoordinates = JSON.parse(div.dataset.mapCoordinates);
                const markerCoordinates = (div.dataset.mapMarkers || '').split(';')
                const map = L.map(div.lastElementChild.firstElementChild).setView(mapCoordinates, 13);
                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

                for(const coordinates of markerCoordinates)
                    coordinates && L.marker(JSON.parse(coordinates)).addTo(map);

                // Manually toggle show placeholder
                div.classList.add('show-ph');
            },

            /**
             *
             * @param {HTMLDivElement} serviceDiv
             */
            /*onReject: (iframe, serviceDiv) => {
                // remove: div[data-service] > div[placeholder] > div.leaflet-map
                serviceDiv.lastElementChild.firstElementChild.remove();
            },

            languages : {
                en : {
                    notice: 'This content is hosted by a third party. By showing the external content you accept the <a rel="noreferrer noopener" href="#link_twitch" target="_blank">terms and conditions</a> of twitch.com.',
                    loadBtn: 'Load once',
                    loadAllBtn: "Don't ask again"
                }
            }
        },*/

        twitter : {
            //thumbnailUrl: '/includes/plugins/twitter/images/twitter-logo-x.jpg',

            onAccept: async (div, setIframe) => {
                await loadScript('https://platform.twitter.com/widgets.js');
                await im.childExists({childProperty: 'twttr'});
                const tweet = await twttr.widgets.createTweet(div.dataset.id, div.firstElementChild);
                tweet && setIframe(tweet.firstChild);
            },

            onReject: async (iframe, serviceDiv, showNotice) => {
                await im.childExists({parent: serviceDiv});
                showNotice();
                serviceDiv.querySelector('.twitter-tweet').remove();
            },

            languages : {
                en : {
                    notice: 'This content is hosted by a third party. By showing the external content you accept the <a rel="noreferrer noopener" href="https://help.twitter.com/en/rules-and-policies/x-cookies" target="_blank">terms and conditions</a> of twitter.com.',
                    loadBtn: 'Load once',
                    loadAllBtn: "Don't ask again"
                },
				
				de : {
                    notice: 'Dieser Inhalt wird von einem Dritten gehostet. Durch das Anzeigen der externen Inhalte akzeptieren Sie die <a rel="noreferrer noopener" href="https://help.twitter.com/de/rules-and-policies/x-cookies" target="_blank">Allgemeine Geschäftsbedingungen</a> von twitter.com.',
                    loadBtn: 'Einmal laden',
                    loadAllBtn: "Fragen Sie nicht noch einmal"
                },
				
				it : {
                    notice: 'Questo contenuto è ospitato da una terza parte. Mostrando il contenuto esterno accetti i <a rel="noreferrer noopener" href="https://help.twitter.com/it/rules-and-policies/x-cookies" target="_blank">termini e condizioni</a> di twitter.com.',
                    loadBtn: 'Consenti una volta',
                    loadAllBtn: "Consenti sempre"
                }
            }
        },

        facebook : {

            //embedUrl : 'https://www.facebook.com/{data-id}',
            embedUrl : '/includes/plugins/facebook/images/facebook.png',

            iframe : {
                //allow : 'accelerometer; encrypted-media; gyroscope; picture-in-picture; fullscreen; web-share;',
                allow : '',
            },
            
            languages : {
                en : {
                    notice: 'This content is hosted by a third party. By showing the external content you accept the <a rel="noreferrer noopener" href="https://www.facebook.com/help/336858938174917" target="_blank">terms and conditions</a> of facebook.com.',
                    loadBtn: 'Load once',
                    loadAllBtn: "Don't ask again"
                },
                
                de : {
                    notice: 'Dieser Inhalt wird von einem Dritten gehostet. Durch das Anzeigen der externen Inhalte akzeptieren Sie die <a rel="noreferrer noopener" href="https://de-de.facebook.com/help/336858938174917" target="_blank">Allgemeine Geschäftsbedingungen</a> von facebook.com.',
                    loadBtn: 'Einmal laden',
                    loadAllBtn: "Fragen Sie nicht noch einmal"
                },
                
                it : {
                    notice: 'Questo contenuto è ospitato da una terza parte. Mostrando il contenuto esterno accetti i <a rel="noreferrer noopener" href="https://it-it.facebook.com/help/336858938174917" target="_blank">termini e condizioni</a> di facebook.com.',
                    loadBtn: 'Consenti una volta',
                    loadAllBtn: "Consenti sempre"
                }
            }
        },

        'facebook-post' : {
            embedUrl : 'https://www.facebook.com/plugins/post.php?{data-id}',

            iframe : {
                //allow : 'accelerometer; encrypted-media; gyroscope; picture-in-picture; fullscreen; web-share;',
                allow : '',
            },

            languages : {
                en : {
                    notice: 'This content is hosted by a third party. By showing the external content you accept the <a rel="noreferrer noopener" href="https://www.facebook.com/help/336858938174917" target="_blank">terms and conditions</a> of facebook.com.',
                    loadBtn: 'Load once',
                    loadAllBtn: "Don't ask again"
                },
				
				de : {
                    notice: 'Dieser Inhalt wird von einem Dritten gehostet. Durch das Anzeigen der externen Inhalte akzeptieren Sie die <a rel="noreferrer noopener" href="https://de-de.facebook.com/help/336858938174917" target="_blank">Allgemeine Geschäftsbedingungen</a> von facebook.com.',
                    loadBtn: 'Einmal laden',
                    loadAllBtn: "Fragen Sie nicht noch einmal"
                },
				
				it : {
                    notice: 'Questo contenuto è ospitato da una terza parte. Mostrando il contenuto esterno accetti i <a rel="noreferrer noopener" href="https://it-it.facebook.com/help/336858938174917" target="_blank">termini e condizioni</a> di facebook.com.',
                    loadBtn: 'Consenti una volta',
                    loadAllBtn: "Consenti sempre"
                }
            }
        },
/*
        googlemaps: {

            embedUrl: 'https://www.google.com/maps/embed?pb={data-id}',

            iframe: {
                allow : 'picture-in-picture; fullscreen;'
            },

            languages: {
                en : {
                    notice: 'This content is hosted by a third party. By showing the external content you accept the <a rel="noreferrer noopener" href="https://cloud.google.com/maps-platform/terms" target="_blank">terms and conditions</a> of Google Maps.',
                    loadBtn: 'Load once',
                    loadAllBtn: "Don't ask again"
                },
				
				de : {
                    notice: 'Dieser Inhalt wird von einem Dritten gehostet. Durch das Anzeigen der externen Inhalte akzeptieren Sie die <a rel="noreferrer noopener" href="https://cloud.google.com/maps-platform/terms" target="_blank">Allgemeine Geschäftsbedingungen</a> von Google Maps.',
                    loadBtn: 'Einmal laden',
                    loadAllBtn: "Fragen Sie nicht noch einmal"
                },
				
				it : {
                    notice: 'Questo contenuto è ospitato da una terza parte. Mostrando il contenuto esterno accetti i <a rel="noreferrer noopener" href="https://cloud.google.com/maps-platform/terms" target="_blank">termini e condizioni</a> di Google Maps.',
                    loadBtn: 'Consenti una volta',
                    loadAllBtn: "Consenti sempre"
                }
            }
        },

        googlemapsapi: {

            onAccept: async (div, setIframe) => {

                await loadScript(`https://maps.googleapis.com/maps/api/js?key=${MAPS_API_KEY}`);
                await im.childExists({childProperty: 'google'});

                // The location of Uluru
                const uluru = {
                    lat: parseInt(div.dataset.mapsLat),
                    lng: parseInt(div.dataset.mapsLng)
                };

                // The map, centered at Uluru
                const map = new google.maps.Map(div.querySelector('.map'), {
                    zoom: 4,
                    center: uluru
                });

                if(div.dataset.mapsMarker === ''){
                    // The marker, positioned at Uluru
                    const marker = new google.maps.Marker({
                        position: uluru,
                        map: map,
                    });
                }

                if(div.dataset.mapsStreetview === ''){
                    const panorama = new google.maps.StreetViewPanorama(div.querySelector('.map'), {
                            position: uluru,
                            pov: {
                                heading: 34,
                                pitch: 10,
                            },
                        }
                    );

                    map.setStreetView(panorama);
                }

                await im.childExists({parent: div}) && setIframe(div.querySelector('iframe'));
            },

            onReject: async (iframe, serviceDiv, showNotice) => {
                await im.childExists({parent: serviceDiv});
                showNotice();
                serviceDiv.querySelector('.map').remove();
            },

            languages : {
                en : {
                    notice: 'This content is hosted by a third party. By showing the external content you accept the <a rel="noreferrer noopener" href="https://www.youtube.com/t/terms" target="_blank">terms and conditions</a> of youtube.com.',
                    loadBtn: 'Load once',
                    loadAllBtn: "Don't ask again"
                },
				
				de : {
                    notice: 'Dieser Inhalt wird von einem Dritten gehostet. Durch das Anzeigen der externen Inhalte akzeptieren Sie die <a rel="noreferrer noopener" href="https://www.youtube.com/t/terms" target="_blank">Allgemeine Geschäftsbedingungen</a> von youtube.com.',
                    loadBtn: 'Einmal laden',
                    loadAllBtn: "Fragen Sie nicht noch einmal"
                },
				
				it : {
                    notice: 'Questo contenuto è ospitato da una terza parte. Mostrando il contenuto esterno accetti i <a rel="noreferrer noopener" href="https://www.youtube.com/t/terms" target="_blank">termini e condizioni</a> di youtube.com.',
                    loadBtn: 'Consenti una volta',
                    loadAllBtn: "Consenti sempre"
                }
            }
        },*/

        instagram: {
            onAccept: async (div, setIframe) => {
                await loadScript('https://www.instagram.com/embed.js');
                await im.childExists({childProperty: 'instgrm'}) && instgrm.Embeds.process();
                await im.childExists({parent: div}) && setIframe(div.querySelector('iframe'));
            },

            onReject: (iframe) => {
                iframe && iframe.remove();
            },

            languages: {
                en : {
                    notice: 'This content is hosted by a third party. By showing the external content you accept the <a rel="noreferrer noopener" href="https://help.instagram.com/581066165581870" target="_blank">terms and conditions</a> of instagram.com.',
                    loadBtn: 'Load once',
                    loadAllBtn: "Don't ask again"
                },
				
				de : {
                    notice: 'Dieser Inhalt wird von einem Dritten gehostet. Durch das Anzeigen der externen Inhalte akzeptieren Sie die <a rel="noreferrer noopener" href="https://help.instagram.com/581066165581870" target="_blank">Allgemeine Geschäftsbedingungen</a> von instagram.com.',
                    loadBtn: 'Einmal laden',
                    loadAllBtn: "Fragen Sie nicht noch einmal"
                },
				
				it : {
                    notice: 'Questo contenuto è ospitato da una terza parte. Mostrando il contenuto esterno accetti i <a rel="noreferrer noopener" href="https://help.instagram.com/581066165581870" target="_blank">termini e condizioni</a> di instagram.com.',
                    loadBtn: 'Consenti una volta',
                    loadAllBtn: "Consenti sempre"
                }
            }
        },

           tiktok: {
            
			embedUrl: `https://www.tiktok.com/embed/v2/{data-id}?embedFrom=webapp_preview" id="tiktok1" frameborder="0" style="visibility: unset;width: 320px;border: none;`,

            iframe : {
                //allow : 'accelerometer; encrypted-media; gyroscope; picture-in-picture; fullscreen;',
                allow : '',
            },
			
			//onAccept: async (div, setIframe) => {
            //    await loadScript('https://www.tiktok.com/embed.js');
            //    await im.childExists({childProperty: 'tiktok'}) && tiktok.Embeds.process();
            //    await im.childExists({parent: div}) && setIframe(div.querySelector('iframe'));
            //},

            //onReject: (iframe) => {
            //    iframe && iframe.remove();
            //},

            languages: {
                en : {
                    notice: 'This content is hosted by a third party. By showing the external content you accept the <a rel="noreferrer noopener" href="https://www.tiktok.com/legal/page/eea/terms-of-service/en" target="_blank">terms and conditions</a> of tiktok.com.',
                    loadBtn: 'Load once',
                    loadAllBtn: "Don't ask again"
                },
				
				de : {
                    notice: 'Dieser Inhalt wird von einem Dritten gehostet. Durch das Anzeigen der externen Inhalte akzeptieren Sie die <a rel="noreferrer noopener" href="https://www.tiktok.com/legal/page/eea/terms-of-service/en" target="_blank">Allgemeine Geschäftsbedingungen</a> von tiktok.com.',
                    loadBtn: 'Einmal laden',
                    loadAllBtn: "Fragen Sie nicht noch einmal"
                },
				
				it : {
                    notice: 'Questo contenuto è ospitato da una terza parte. Mostrando il contenuto esterno accetti i <a rel="noreferrer noopener" href="https://www.tiktok.com/legal/page/eea/terms-of-service/en" target="_blank">termini e condizioni</a> di tiktok.com.',
                    loadBtn: 'Consenti una volta',
                    loadAllBtn: "Consenti sempre"
                }
            }
        },
		
		reddit: {
            
			//embedUrl: `https://www.reddit.com/embed/v2/{data-id}?embedFrom=webapp_preview" id="reddit1" frameborder="0" style="visibility: unset;width: 320px;height: 758px;border: none;border-radius: 8px;`,
			
			embedUrl: `https://embed.reddit.com/r/{data-id}/`,

            iframe : {
                //allow : 'accelerometer; encrypted-media; gyroscope; picture-in-picture; fullscreen;',
                allow : '',
            },
			
			//onAccept: async (div, setIframe) => {
            //    await loadScript('https://www.reddit.com/embed.js');
            //    await im.childExists({childProperty: 'reddit'}) && reddit.Embeds.process();
            //    await im.childExists({parent: div}) && setIframe(div.querySelector('iframe'));
            //},

            //onReject: (iframe) => {
            //    iframe && iframe.remove();
            //},

            languages: {
                en : {
                    notice: 'This content is hosted by a third party. By showing the external content you accept the <a rel="noreferrer noopener" href="https://www.reddit.com/it-it/policies/privacy-policy" target="_blank">terms and conditions</a> of reddit.com.',
                    loadBtn: 'Load once',
                    loadAllBtn: "Don't ask again"
                },
				
				de : {
                    notice: 'Dieser Inhalt wird von einem Dritten gehostet. Durch das Anzeigen der externen Inhalte akzeptieren Sie die <a rel="noreferrer noopener" href="https://www.reddit.com/it-it/policies/privacy-policy" target="_blank">Allgemeine Geschäftsbedingungen</a> von reddit.com.',
                    loadBtn: 'Einmal laden',
                    loadAllBtn: "Fragen Sie nicht noch einmal"
                },
				
				it : {
                    notice: 'Questo contenuto è ospitato da una terza parte. Mostrando il contenuto esterno accetti i <a rel="noreferrer noopener" href="https://www.reddit.com/it-it/policies/privacy-policy" target="_blank">termini e condizioni</a> di reddit.com.',
                    loadBtn: 'Consenti una volta',
                    loadAllBtn: "Consenti sempre"
                }
            }
        },

        /*vimeo: {
            embedUrl: 'https://player.vimeo.com/video/{data-id}',

            iframe: {
                allow : 'fullscreen; picture-in-picture;'
            },

            thumbnailUrl: async (dataId, setThumbnail) => {
                const url = `https://vimeo.com/api/v2/video/${dataId}.json`;
                const response = await (await fetch(url)).json();
                const thumbnailUrl = response[0].thumbnail_large;
                thumbnailUrl && setThumbnail(thumbnailUrl);
            },

            languages: {
                en : {
                    notice: 'This content is hosted by a third party. By showing the external content you accept the <a rel="noreferrer noopener" href="https://vimeo.com/terms" target="_blank">terms and conditions</a> of vimeo.com.',
                    loadBtn: 'Load once',
                    loadAllBtn: "Don't ask again"
                },
				
				de : {
                    notice: 'Dieser Inhalt wird von einem Dritten gehostet. Durch das Anzeigen der externen Inhalte akzeptieren Sie die <a rel="noreferrer noopener" href="https://vimeo.com/terms" target="_blank">Allgemeine Geschäftsbedingungen</a> von vimeo.com.',
                    loadBtn: 'Einmal laden',
                    loadAllBtn: "Fragen Sie nicht noch einmal"
                },
				
				it : {
                    notice: 'Questo contenuto è ospitato da una terza parte. Mostrando il contenuto esterno accetti i <a rel="noreferrer noopener" href="https://vimeo.com/terms" target="_blank">termini e condizioni</a> di vimeo.com.',
                    loadBtn: 'Consenti una volta',
                    loadAllBtn: "Consenti sempre"
                }
            }
        }*/

    }
});


const acceptAll = document.getElementById('accept-all');
const rejectAll = document.getElementById('reject-all');

//acceptAll.addEventListener('click', () => im.acceptService('all'));
//rejectAll.addEventListener('click', () => im.rejectService('all'));


/**
 * Dynamically load script (append to head)
 * @param {string} src
 * @returns {Promise<boolean>} promise
 */
function loadScript(src) {

    /**
     * @type {HTMLScriptElement}
     */
    let script = document.querySelector('script[src="' + src + '"]');

    return new Promise((resolve) => {

        if(script)
            return resolve(true);

        script = document.createElement('script');

        script.onload = () => resolve(true);
        script.onerror = () => {
            /**
             * Remove script from dom if error is thrown
             */
            script.remove();
            resolve(false);
        };

        script.src = src;

        document.head.appendChild(script);
    });
};
