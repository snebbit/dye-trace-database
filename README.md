# dye-trace-database
Dye Trace Database web platform for browsing hydrological dye-tracing results

Based on the Northern Dye Trace Database, this will require some reworking to get your own dataset running, but most bits have been abstracted to a config file. It's currently aimed at running on the UK's Ordnance Survey grid system for location data, but this should be easily reworkable to run on lat/long, and the Geodesy library included should make it easy to migrate to other countries' grid systems.

## Features
* Map view using Google Maps
* Dataset download as CSV
* Search form
* Contribution form for others to submit their data
* Caching of data and markup to reduce server load and db queries

## Setup
* Upload files to a hosted directory
* Rename includes/config-example.php to includes/config.php
* Add the various settings in there such as base URL (with a trailing slash), email address, database connection details
* Content areas to complete include the homepage paragraph and the About page
* Create the directory var/cache/ and make it writeable

## Screenshots

![Homepage](/_docs/screenshot-home.JPG)

![Map view](/_docs/screenshot-map.JPG)

![Table](/_docs/screenshot-table.JPG)

![Contribution form](/_docs/screenshot-contribute.JPG)

![Search](/_docs/screenshot-search.JPG)
