=== Cr3ativ Careers ===
Contributors: Cr3ativ
Tags: careers, jobs
Requires at least: 3.0.1
Tested up to: 4.9
Stable tag: 1.2.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Cr3ativ Careers enables you to display career opportunities, via department, on your WordPress website.


== Description ==

Easily add unlimited career / job opportunities to your website via departments along a print button and a pdf upload ability to allow for application download, privacy policy, terms and conditions etc.  

For your convenience, the plugin also contains a directory called language files, where you will find the mo/po files you may use for translation purposes.

Here is [the demo](http://mythemepreviews.com/plugins/job-listings/ "the demo").


== Required Files ==

Included in the templates directory are:
single-cr3ativcareers.php
template-cr3ativcareers.php
taxonomy-cr3ativdepartment.php

You will need to upload all of the above templates in to your theme's root directory. 


== Installation ==

1. Upload the `cr3ativ-careers` folder to your to the `/wp-content/plugins/` directory or alternatively upload the cr3ativ-careers.zip via the plugin page of WordPress by clicking 'Add New' and select the zip from your local computer.

2. Activate the plugin through the 'Plugins' menu in WordPress.

3. You will see a new post type on the left of the WP admin menu 'Job Listings'.

4. Inside the 'cr3ativ-careers' plugin folder, there is a directory called 'templates', upload the template(s) into your current theme directory (as mentioned above). Do not upload the actual template folder, just the files within it!

5. Under the ‘Job Listings’ menu option, you will see ‘Careers Options’.  This section enables you to alter the ‘slug’ name that appears in the address bar when visiting single job listing and department pages. The defaults would read as:

http://yourdomain.com/cr3ativcareers/yourjoblistingtitle 

http://yourdomain.com/cr3ativdepartment/yourdepartmentname  

With this option you can set the name of the slug to be whatever you wish (in accordance with WordPress slug naming conventions).


== Creating a Single Job Listing ==

1. Click ‘Job Listings > Add New' and enter all relevant information including full regular content as you would normally achieve in WordPress when creating a post or page. It’s recommended that the title of the post is the job position title.

2. Below the regular content area you should see a special area named ‘Career Data’ - if you do not see this then please click ‘Screen Options’ at the top of the screen and ensure everything is checked so you can see everything).

3. You will see the following options: 

Print Icon Text - used to display a clickable link for users to print your page example being: ‘Print This Page’
 
Download Icon Text - Used to describe the download of a PDF if attached using the next section.

Attach PDF - if you have uploaded any PDF files to your WordPress media library they will be available to choose from the drop down in this area. You cannot upload via this box the PDF file should already be within your media library for it to be shown here.

4. On the right of the screen you will see a new box named ‘Department’ - this is used to categorize your job listings easily - an example being HR, Finance Department, Office, R+D etc basically departments in your company or organization - either choose an existing department or create a new one for it to be assigned.

5. Click Publish.


== Widget and Sidebar Area ==

The Cr3ativ Careers plugin comes not only with a useful widget to display current positions available, but also the single job pages and the index page has a registered sidebar you can use for any widgets. Simply visit your ‘Appearance > Widgets’ menu in WordPress admin and you will see a new registered sidebar called ‘Cr3ativ Careers Page’, you will also notice a new widget available named ‘Career Loop’. Drag an instance of the widget to any available widget area and complete the usual details which include:

Title
#Display - numerical amount of jobs to display for example: 3
Choose to sort ASC (click the checkmark) or the default Desc order by unselecting the checkmark if necessary.

Click Save.


== Creating a Job Listing Index page ==

1. Navigate to your WordPress admin > Pages and Add New

2. Give your page a title such as Jobs or Careers etc You may also add regular content as normal that will appear above the job listings.

3. Choose ‘Cr3ativ-Careers’ template from the right side of the page in the box titled ‘Page Attributes > Template’.

4. Click Publish and add this to your menu if your theme does not automatically add new pages to your site-wide menu system.



== Creating a Job Listing Index page for a Single Department ==

1. Navigate to your WordPress admin menu and select ‘Appearance > Menus’.

2. Look for the box on the left that is titled ‘Department’ - this lists all the departments you have created and therefore simply click to add any department to your menu system.


== Adding a single Job Listing to your menu ==

1. Navigate to your WordPress admin menu and select ‘Appearance > Menus’.

2. Look for the box on the left that is titled ‘Job Listings’ - this lists all the jobs you have published, simply click to add any job to your menu system.


== Screenshots ==

1. Job listing admin view
2. Adding a new job
3. Department category page
4. Pretty permalink settings (remember to click save on Settings > Permalinks if you receive 404 page errors)
5. Career loop widget


== Styling ==

Styling for these page templates are included in the includes directory under :

/includes/css/cr3ativcareer.css


== Changelog ==

= 1.2.0 =
Updated widget section to support WP 4.9 and fixed PHP notices and deprecated calls.

= 1.1.0 =
Updated widget section to support WP 4.3.

= 1.0.4 =
Updated admin column view incase short codes are being used and added CSS to column to scroll when a lot of text is used in the content area.

= 1.0.3 =
* Updated admin view and language files.

= 1.0.2 =
* Updated main template page (template-cr3ativcareers.php) to include pagination.  This setting is based on the WordPress Settings > Reading selection.

= 1.0.1 =
* Updated plugin to include ability to set slug names for single and category pages.

= 1.0.0 =
* First release.

