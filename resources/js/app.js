import './bootstrap';
// import "../css/app.css"; // do this if not directly calling the css from the vite.config file. 
// If you do this, then also remove the calling of css from the layout.blade.php. 
// Calling it here is a common method when developing Single page applications.

// Select the h1 element by its id
const h1Element = document.getElementById('replaceable');
// Replace its text content
h1Element.textContent = 'This is Done by Javascript hiding in the app.js file and invoked by the layout.blade.php file through vite.config.js, but originally implemented into the code by vite.config';