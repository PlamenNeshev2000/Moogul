# Moogul
In my third semester, my group and I created a blog like website for students called Moogul. 

Main Features:
- Adding a post
- Liking a post
- Adding a comment 
- Deleting comment/post

Visit the website:
http://i433416.hera.fhict.nl


### Local Set Up
- [Download & install last version PHP](https://www.php.net/downloads.php)
- [PHP Install Tutorial Windows](https://www.youtube.com/watch?v=iW0B9NTId2g)

In your terminal:
```bash
$ cd [PROJECT FOLDER]
$ cd website/
$ php -S localhost:8080
```
Open [localhost:8080](localhost:8080) in your browser

### File Structure
```bash
└───Website
    │   _functions.php      # holds the functions for all PHP pages
    │   ### PAGES ###
    │   about.php
    │   contact.php
    │   courses.php
    │   index.php
    │   news.php
    │   ### PAGES ###
    │
    ├───assets
    │   ├───css
    │   │   │   style.css   # includes base, elements & components in one CSS file
    │   │   ├───01-base
    │   │   ├───02-elements
    │   │   └───03-components
    │   ├───images
    │   └───js              # javascript files
    │
    └───components          # holds components/sections which will be added to multiple pages
```
