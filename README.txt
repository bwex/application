####Installation instructions for hotspot administrator system#####

After extracting the provided zip file, you should see the following files:

1. This readme file

2. An index.php file

3. A .htaccess file

4. Vendor folder

5. Logs folder (not used)

6. Core folder

7. App folder.

the mentioned files must be moved to the root directory of the "www" folder of apache web server.

Inside the App folder there are three more folders, Controllers, Models, and Views folders. The other file inside App folder is a Config.php file.

It is in this config.php file that database connection parameters should be set. 

mysql database that must connected to is the one that the freeradius server is configured to use.

To access the application user must enter the ip address of the apache hosting the application, just localhost if it is on the same server.