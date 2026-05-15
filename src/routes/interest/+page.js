export async function load({ fetch }) {
    try{    const response = await fetch('https://de1.api.radio-browser.info/json/stations/search?has_geo_info=true&order=votes');

    const cekilenVeri = await response.json();
    return {
        datas: cekilenVeri
    };
    }
    catch(err){
        console.error(err);
    }
}
