banes-bicycle-shops
===================

Script for importing bicycle shop location data in Bath & North East Somerset into Socrata, pulled from the Google Places API

## Accessing the data

Drop in your credentials for the following at the top of the index.php file: 

* root_url - Your Socrata datastore root URL
* app_token - You can get this by creating a new app in your Socrata profile
* database_id - This is the 8-character code at the end of your dataset URL. It should be in the format XXXX-XXXX
* username - This is your Socrata username, mostly likely an email address
* password - Your Socrata password
* google_key - Your Public API access key available by creating an app in the Google Developers Console. Ensure the Google Maps Engine API and Places API are enabled in your app.

Now run the file. An output of all bicycle shops imported into Socrata will show along with a 'Done!' message when completed.