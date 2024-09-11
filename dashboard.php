<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" media="screen">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/solid.min.css">

    <link href="./style.css" rel="stylesheet">
    <link rel="shortcut icon" href="image/hpsslogo.jpg" type="image/x-icon">
    
    <link href="https://cdn.datatables.net/2.1.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="dashboard.css" />
    
  </head>
  <body>

  <?php include "navbar.php" ?>
  
    <div style="padding: 40px; text-align: center;">
      <h1> Welcome to Admin Page..........</h1>
    </div>

    

<div id="content">
  <!-- Yahaan par content dikhaya jayega -->
</div>


     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-advanced-news-ticker/1.0.1/js/newsTicker.min.js"></script>
    <script src="https://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v4.0.4.min.js"></script>
    
     <script>
     //nepali date
      currMonth = NepaliFunctions.GetCurrentBsMonth();
      currDay = NepaliFunctions.GetCurrentBsDay();
      currYear = NepaliFunctions.GetCurrentBsYear();
      
      day = NepaliFunctions.GetBsFullDayInUnicode({year: currYear, month: currMonth, day: currDay});
      currentDate = NepaliFunctions.GetBsFullDate({year: currYear, month: currMonth, day: currDay}, true);

      full_date = day + ', ' + currentDate;
      document.getElementById("nepali_date").innerHTML = full_date;
      
   </script>
   <script>
      function updateDates() {
        const currentDate = new Date();

        // Update English date
        const options = {
          year: "numeric",
          month: "long",
          day: "numeric",
          weekday: "long",
        };
        document.getElementById("english_date").textContent =
          currentDate.toLocaleDateString("en-US", options);

        // Update Nepali date (replace with your actual logic)
        const nepaliDate = getNepaliDate(currentDate); // Your logic to get Nepali date
        document.getElementById("nepali_date").textContent = nepaliDate;
      }

      // Call the updateDates function to update dates on page load
      updateDates();

      // Update dates every second
      setInterval(updateDates, 1000);
    </script>
  </body>
</html>
