#WP Plugin for SAMM self assessment
Provides a self assessment test based on SAMM to get quick insight in your IT security.

## Description
This plugin presents a self assessment based on SAMM 1.1. Users can get a quick insight in their security status.
Use the shortcode:
[samm]
In a post or page to enable this self-assessment test!

See https://nocomplexity.com/samm/ for a live demo.

# How does it work?
This module displays a multi-step form with questions derived from SAMM 1.1. Note: This is not the complete SAMM asessment, since
this tool is provided for people to get a quick overview of their status. See the SAMM guide for more detailed information on the process.
The questions can be easily changed by editing the text files. Extra questions per topic (or less) is also possible.

All SAMM questions in this assessment are based on the SAMM OWASP project:
The Software Assurance Maturity Model (SAMM) was originally developed, designed, and written by
Pravir Chandra (chandra@owasp.org).This Wordpress pluging contains slighly modified questions of SAMM1.1 draft. 
See: http://www.opensamm.org/ for more information on SAMM and available (free) material to IT security within your organisation 

NO information from the form is stored. So no ip-adressess or other end-user retrievable information. Advantage is that this plugin stores nothing in the WP database tables. 
Also no dedicated database tables are created. We keep it clean and simple!

#Installation
Follow this steps to install this plugin:
Download the zip-file

1. Download the plugin(zip) into the **/wp-content/plugins/** folder
2. Activate the plugin through the 'Plugins' menu in WordPress

Create a page or post with the tag:
[samm] 
