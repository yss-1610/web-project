 <script>
    let {data} = $props();
    import { onMount, onDestroy } from 'svelte';
    
    let mapElement =$state();
    let map =$state();

    let currentAudio = null;

    function playRadio(url) {
        if (currentAudio) {
            currentAudio.pause();
            currentAudio.src = ""; 
        }

        currentAudio = new Audio(url);
        currentAudio.play().catch(err => {
            console.error("Radyo oynatılamadı, tarayıcı engellemiş olabilir:", err);
            alert("Bu radyo şu an oynatılamıyor veya tarayıcı otomatik oynatmayı engelledi.");
        });
    }
    onMount(async () => {

        const leaflet = await import('leaflet');
        map = leaflet.map(mapElement).setView([39.0, 35.0], 5);
        
        leaflet.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        
        if (data && data.datas) {
            data.datas.forEach(station => {
                
                if (station.geo_lat && station.geo_long) {
                    
                    const popupContainer = document.createElement('div');
                    const infoText = document.createElement('div');
                    const playBtn = document.createElement('button');
                    infoText.innerHTML = `<b>${station.name}</b><br><small>${station.tags}</small><br><br>`;
                    playBtn.innerText = 'Oynat';
                    playBtn.style.padding = '5px 10px';
                    playBtn.style.background = '#ff4a4a';
                    playBtn.style.color = 'white';
                    playBtn.style.border = 'none';
                    playBtn.style.borderRadius = '5px';
                    playBtn.onclick = () => {
                        if (station.url_resolved) {
                            const streamUrl = station.url_resolved||station.url;
                            playRadio(streamUrl);
                        } else {
                            alert("Bu radyonun yayın linki eksik.");
                        }
                    };
                    popupContainer.appendChild(infoText);
                    popupContainer.appendChild(playBtn);
                    leaflet.marker([station.geo_lat, station.geo_long]).bindPopup(popupContainer).addTo(map)
                }
            });
        }
    });

    onDestroy(async () => {
        if(map) {
            map.remove();
            currentAudio.pause();
            currentAudio.src = "";
        }
    });
 </script>
<section>
 <div class="map" bind:this={mapElement}></div>
</section>