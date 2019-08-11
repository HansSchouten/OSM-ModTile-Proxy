# OSM - mod_tile proxy
Serve mod_tile rendered tiles and tiles from the OSM tile servers during rendering.
This will save disk space compared to pre-rendering all tiles, while still offering the ability to have some zoom levels pre-rendered. Missing tiles are requested from OpenStreetMap tile servers, while in the background the server will render tiles of the requested area to speed up subsequent requests.

Inspired by: https://wiki.openstreetmap.org/wiki/ProxySimplePHP

Use in combination with: https://switch2osm.org/manually-building-a-tile-server-18-04-lts/
