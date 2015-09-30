# Template Diagrams

A web services app that generates exploratory tree diagrams of Cascade Server Templates.

**index.html**

PHP form displaying a dropdown of folder IDs, containing Templates.

**template.php**

This is the main page of the project. Once a template ID is selected from the dropdown, it displays an entity relationship tree by sending a GET request to the json.php and fetching data about all related configuration sets, content types and pages, in JSON format. It passes this JSON data to the D3 API, which visualizes it as a tree, using SVG.

**choose-template.php**

This file is included in template.php. It generates a template dropdown menu. It requires the 32-digit ID of the folder that contains the Templates.

**json.php**

Aggregates the names of all the configuration sets, content types and pages related to a Template, in JSON format.
