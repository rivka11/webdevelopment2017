<!DOCTYPE HTML>
<head
    >
        
    <link rel="stylesheet" href= "styles/testpopupstyles.css"/>
</head>
<h1>Popup/Modal Windows without JavaScript</h1>
<div id="wrapper">
  <p><a class="button" href="#popup1">Click Me</a></p>
    <p><a class="button" href="#popup2">Click Me Too</a></p>
</div>

<div id="popup1" class="overlay">
    <div class="popup">
        <h2>Info box</h2>
        <a class="close" href="#">&times;</a>
        <div class="content">
            <p>This is done totally without JavaScript. Just HTML and CSS.</p>
        </div>
    </div>
</div>

<div id="popup2" class="overlay light">
    <a class="cancel" href="#"></a>
    <div class="popup">
        <h2>What the what?</h2>
        <div class="content">
      <p>Click outside the popup to close.</p>
        </div>
    </div>
</div>