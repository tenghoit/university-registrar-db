<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Courses</h2>
    <h3>Add:</h3>
    <form action="../includes/formhandler.inc.php" method="post">
        <input type="text" name="course_discipline" placeholder="course_discipline">
        <input type="text" name="course_number" placeholder="course_number">
        <input type="text" name="course_name" placeholder="course_name">
        <input type="number" name="course_credits" placeholder="course_credits">
        <input type="text" name="course_description" placeholder="course_description">
        <button type="submit">Submit</button>
    </form>
</body>
</html>