Goggle-Plus-Images
==================

This PyroCMS module lets you put your Google+ Photos on your website.  It will output all your public photo albums on a page.  You can navigate into each album and view the photos.  The image files are not saved on your server, the data is pulled using xml from Google's servers.  New albums and photos are pulled in instantly to your website.

Steps to setup: 

- Add these files to addons/shared_addons/modules/gplusphotos in your pyrocms root.
- Log into the admin and enter your google id in Settings -> Gplusphotos -> Google ID
- Add your albums to a page by adding this code to the html: {{ gplusphotos:albums }}
