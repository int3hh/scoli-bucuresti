<div class="container-fluid p-4">
    <div class="flex flex-col lg:flex-row">
        <div id="map" class="lg:w-1/2 w-full h-96 relative map">
            
        </div>

        <div class="lg:block lg:w-1/2 lg:ml-8 mt-20 lg:mt-0">
            mea
        </div>
    </div>  
    
    <script type="text/javascript">

    var schools = {!! $schools !!};


    mapboxgl.accessToken = 'pk.eyJ1IjoiY3J5cHRvY3ViZTIiLCJhIjoiY2xhdTE0MXkyMDF5YjN3cjY1bm81Mmw5ZSJ9.jfTasCmjT7jXXX6R8VZaVA';
    const map = new mapboxgl.Map({
    container: 'map', // container ID
    style: 'mapbox://styles/mapbox/streets-v12', // style URL
    center: [ 26.094561, 44.43771811], // starting position [lng, lat]
    zoom: 10, // starting zoom
    zoomControl: true,
    });

    map.addControl(new mapboxgl.NavigationControl());

    let markers = [];

    map.on('load', () => {
        schools.forEach((item) => {
            const col = item.privat ? '#f6c345' : '#00b23d';
            const marker = new mapboxgl.Marker({
                color: col,
                }).setLngLat([item.lon, item.lat])
            .addTo(map);
            markers.push(marker)
            marker.getElement().addEventListener('click', () => {
                alert("Clicked " + item.id);
            });
        });
    });

</script>
</div>