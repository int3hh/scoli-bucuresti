<div class="mx-4">
    <div class="container rounded-2xl overflow-hidden">
        <div class="flex flex-col lg:flex-row h-custom">
            <div id="map" class="w-full relative map rounded-custom h-full">
            <div id="spinner" class="spinner" style="align-self: center;">
                <div class="rect1"></div>
                <div class="rect2"></div>
                <div class="rect3"></div>
                <div class="rect4"></div>
                <div class="rect5"></div>
            </div>
        </div>
        <div class="absolute bg-white rounded-tl-lg rounded-br-lg px-4 py-2">
            <span> <i style="color: #f6c345" class="fa-solid fa-location-pin"></i> Scoli private &nbsp; <i style="color: #00b23d" class="fa-solid fa-location-pin"></i> Scoli de stat </span>
        </div>
        <div id="card" class="lg:w-1/2 absolute lg:ml-4 mt-auto mr-4 bottom-4 lg:bottom-8 bg-white p-4 rounded-2xl" style="display:none;">
            <livewire:detalii-component />
        </div>
    </div>  
</div>

    
<script type="text/javascript">
    var schools = {!! $schools !!};


    mapboxgl.accessToken = 'pk.eyJ1IjoiY3J5cHRvY3ViZTIiLCJhIjoiY2xhdTE0MXkyMDF5YjN3cjY1bm81Mmw5ZSJ9.jfTasCmjT7jXXX6R8VZaVA';
    const map = new mapboxgl.Map({
        container: 'map', 
        style: 'mapbox://styles/mapbox/streets-v12', 
        center: [ 26.094561, 44.43771811], 
        zoom: 10,
        zoomControl: true,
    });

    map.addControl(new mapboxgl.NavigationControl());

    let markers = [];
    let prevSelected = undefined;

    map.on('load', () => {
        const loader = document.getElementById('spinner');
        loader.style.display = 'none';
        schools.forEach((item, idx) => {
            const col = item.privat ? '#f6c345' : '#00b23d';
            const marker = new mapboxgl.Marker({
                color: col,
                }).setLngLat([item.lon, item.lat])
            .addTo(map);
            markers.push(marker)
            marker.getElement().addEventListener('click', () => {
                const el = markers[idx].getElement();
                el.querySelectorAll('path')[0].setAttribute('fill', '#880808');
                if (prevSelected != undefined) {
                    const old = markers[prevSelected].getElement();
                    old.querySelectorAll('path')[0].setAttribute('fill', schools[prevSelected].privat ? '#f6c345' : '#00b23d');
                }
                prevSelected = idx;
                document.getElementById('card').style.display = 'block';
                Livewire.emit('updateSchool', item.id);
            });
        });
    });

</script>
