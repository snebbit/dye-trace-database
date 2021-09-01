# dye-trace-database
Dye Trace Database web platform for browsing hydrological dye-tracing results

Based on the Northern Dye Trace Database, this will require some reworking to get your own dataset running, but most bits have been abstracted to a config file. It's currently aimed at running on the UK's Ordnance Survey grid system for location data, but this should be easily reworkable to run on lat/long, and the Geodesy library included should make it easy to migrate to other countries' grid systems.

## Setup
Upload files to a hosted directory
Rename includes/config-example.php to includes/config.php
Add the various settings in there such as base URL (with a trailing slash), email address, database connection details
Content areas to complete include the homepage paragraph and the About page
