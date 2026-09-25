<?php
require_once 'header.php';
?>

<!-- Recreated the guest welcome page using react -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Home Page</title>

    <script src="react.development.js"></script>
    <script src="react-dom.development.js"></script>
    <script src="babel.min.js"></script>

    <script type="text/babel">
        class Guest extends React.Component {
          render() {
            return ( <p><b>Welcome Guest to the student portal.</b> <br />
            Please log in to access more features.</p>
          )
          }      
        }

        ReactDOM.render(<Guest />, document.getElementById('guest_1'));
    </script>
</head>
<body>
    <div class="border" id="guest_1"></div>    
</body>
</html>