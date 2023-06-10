<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Nurse/Clerk - Vaccine Management System</title>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="shortcut icon" href="images/ye.jpg">
</head>
<style>
   /* Global styles */
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  font-family: 'Open Sans', sans-serif;
  color: #333;
}

a {
  color: #007bff;
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
}

/* Header styles */
header {
  background-color: #fff;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  padding: 20px;
  position: sticky;
  top: 0;
  z-index: 100;
}

header nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

header nav ul {
  display: flex;
  flex-flow: row nowrap;
  justify-content: space-between;
  list-style: none;
  margin: 0;
}

header nav li {
  margin-right: 20px;
}

header nav li:last-child {
  margin-right: 0;
}

header nav a {
  font-size: 18px;
  font-weight: bold;
}

header nav a:hover {
  color: #007bff;
}

/* Features section styles */
.features {
  background-color: #f9f9f9;
  padding: 50px 0;
}

.features .box-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  max-width: 1200px;
  margin: 0 auto;
}

.features .box {
  background-color: #fff;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  border-radius: 10px;
  padding: 30px;
  margin: 20px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
  max-width: 300px;
}

.features .box i {
  font-size: 48px;
  margin-bottom: 30px;
  color: #007bff;
}

.features .box a {
  font-size: 24px;
  margin-bottom: 20px;
  color: #333;
  display: flex;
  align-items: center;
}

.features .box a:hover {
  color: #007bff;
}

.features .box a i {
  margin-right: 10px;
}

.image-container {
  max-width: 100%;
  margin-top: 50px;
}

.image-container img {
  width: 100%;
  height: auto;
  max-width: 600px;
  display: block;
  margin: 0 auto;
  border-radius: 10px;
}

/* Responsive styles */
@media screen and (max-width: 768px) {
  header nav ul {
    display: none;
  }
  
CSS code (continued):

  header nav li {
    margin-right: 10px;
  }
  
  header nav li:last-child {
    margin-right: 0;
  }
  
  header nav a {
    font-size: 16px;
  }
  
  .features .box {
    max-width: 250px;
    margin: 10px;
  }
  
  .image-container {
    max-width: 100%;
    margin-top: 30px;
  }
  
  .image-container img {
    max-width: 100%;
    max-height: 400px;
  }
}

/* Features section styles */
.features {
  background-color: #f9f9f9;
  padding: 50px 0;
}

.features .box-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  max-width: 1200px;
  margin: 0 auto;
}

.features .box {
  background-color: #fff;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  border-radius: 10px;
  padding: 30px;
  margin: 20px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
  max-width: 400px;
}

.features .box i {
  font-size: 48px;
  color: #007bff;
  margin-bottom: auto;
}

.features .box a {
  font-size: 24px;
  color: #333;
  display: flex;
  align-items: center;
  margin-top: 20px; /* Add this line */
}

.features .box a:hover {
  color: #007bff;
}

.features .box a i {
  margin-right: 10px;
}
.intro {
         text-align: center;
         margin-bottom: 50px;
      }
      body {
         background-color: #f5f5f5;
         color: #0077b6;
         font-family: Arial, sans-serif;
      }
</style>
<body style="background-color:lightblue">
   <?php @include 'header.php'; ?>
   <section class="intro">
      <h1>Welcome to Our Healthcare Service</h1>
      <p>Our service makes it easy for parents to keep track of their child's healthcare records and generate reports. Sign up today to get started!</p>
   </section>

   <section class="features">
      <div class="box-container">
         <div class="box">
            <a href="register.php"> <i class="fas fa-user-plus"></i> Register</a>
            <a href="schedule.php"> <i class="fas fa-calendar-alt"></i> Schedule</a>
            <a href="vaccinemanagement.php"> <i class="fas fa-syringe"></i> Manage Vaccine</a>
            <a href="seeallergyreport.php"> <i class="fas fa-allergies"></i> See Allergy Report</a>
            <a href="content.php"> <i class="fas fa-plus"></i> Add Content</a>
         </div>
         <div class="image-container">
            <img src="images/nurseclerk.jpg" alt="Nurse/Clerk">
         </div>
      </div>
   </section>
   <?php @include 'footer.php'; ?>
</body>
</html>