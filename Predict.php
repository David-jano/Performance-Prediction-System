<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Performance Prediction</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
<div class="container-fluid bg-primary text-light py-4" style="position:sticky;">
    <h3 class="text-center mb-0"><i class="fa fa-graduation-cap" style="font-size:48px;"></i>&nbsp;&nbsp;Student Performance Prediction System</h3>
</div>

    <div class="container mt-2">
        
        <div class="row"> <!-- Start of the row containing both cards -->
            <!-- Form Card on the Left -->
            <div class="card shadow p-4 col-md-6"> <!-- Use col-md-6 to make it half-width on medium screens and above -->
                <form id="predictionForm">
                    <!-- Gender Input -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="gender">
                                    <option value="1">Male</option>
                                    <option value="0">Female</option>
                                </select>
                                <label for="gender" class="form-label"><i class="fa fa-venus-mars"></i>&nbsp;&nbsp;Gender</label>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="age" placeholder="Age..." required />
                                <label for="age" class="form-label"><i class="fa fa-user-o"></i>&nbsp;&nbsp;Age</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <!-- Year of Study Dropdown -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="year_of_study">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                                <label for="year_of_study" class="form-label"><i class="fa fa-calendar-o"></i>&nbsp;&nbsp;Year of Study</label>
                            </div>
                        </div>
                    
                        <!-- Attendance Input -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="attendance" placeholder="Attendance..." required />
                                <label for="attendance" class="form-label"><i class="fa fa-files-o"></i>&nbsp;&nbsp;Attendance</label>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Health Condition -->
                    <div class="mb-3">
                        <div class="form-floating">
                            <select class="form-select" id="health_condition">
                                <option value="1">Healthy</option>
                                <option value="0">Allergic</option>
                            </select>
                            <label for="health_condition" class="form-label"><i class="fa fa-heartbeat"></i>&nbsp;&nbsp;Health Condition</label>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header bg-primary text-light">
                        <i class="fa fa-users"></i>&nbsp;&nbsp; Family Background Status
                        </div>
                        <div class="card-body">
                            <!-- Family Background Fields -->
                            <div class="mb-3">
                                <label for="family_background_low" class="form-label">Lower Class</label>
                                <input type="number" class="form-control" max="1" min="0" id="family_background_low" value="0">
                            </div>
                            <div class="mb-3">
                                <label for="family_background_middle" class="form-label">Middle Class</label>
                                <input type="number" class="form-control" max="1" min="0" id="family_background_middle" value="0">
                            </div>
                        </div>
                    </div>  

                    <div class="card mt-2">
                        <div class="card-header bg-primary text-light">
                        <i class="fa fa-institution"></i>&nbsp;&nbsp;Department
                        </div>
                        <div class="card-body">
                            <!-- Department Fields -->
                            <div class="row">
    <!-- Computer Science Field -->
    <div class="col-md-6 mb-3">
        <label for="department_computer_science" class="form-label">Computer Science</label>
        <input type="number" class="form-control" max="1" min="0" id="department_computer_science" value="0">
    </div>

    <!-- Electrical Engineering Field -->
    <div class="col-md-6 mb-3">
        <label for="department_electrical_engineering" class="form-label">Electrical Engineering</label>
        <input type="number" class="form-control" maxlength="1" max="1" min="0" id="department_electrical_engineering" value="0">
    </div>
</div>

                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="row text-center">
                        <div class="col-6">
                            <button type="button" class="btn btn-primary w-100 mt-2" onclick="makePrediction()"><i class="fa fa-play"></i>&nbsp;&nbsp;Predict</button>
                        </div>
                        <div class="col-6">
                            <input type="reset" class="btn btn-danger w-100 mt-2" value="Clear">
                        </div>
                    </div>
                </form>

                <!-- Result Section -->
                <div id="predictionResult" class="alert alert-info mt-3" style="display: none;">
                    Prediction: <span id="resultText"></span>
                </div>
            </div> <!-- End of Form Card -->

            <!-- Featured Card on the Right -->
            <div class="col-md-6"> <!-- Use col-md-6 to make it half-width on medium screens and above -->
                <div class="card">
                    <div class="card-header bg-primary text-light">
                    <i class="fa fa-gear"></i>&nbsp;&nbsp; Options
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Did you know?</h5>
                        <p class="card-text">You can View Previous History of Predictions made</p>
                        <form method="POST">
    <input type="submit" name="view" class="btn btn-primary" value="View History">
</form>

<?php
$servername = "localhost";
$username = "root"; 
$password = "";  
$dbname = "warehouse"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle the form submission to view the history
if (isset($_POST['view'])) {
    $sql = "SELECT * FROM prediction_history";  // Query to fetch data from the prediction_history table
    $result = $conn->query($sql);  // Execute the query

    // Check if there are results
    if ($result->num_rows > 0) {
        echo "<h5 class='mt-3'>Prediction History</h5>";
        echo "<div style='max-height: 400px;overflow-x:auto;' class='mt-3'>";  // Container with scrollable content
        echo "<table class='table table-striped'>";
        echo "<thead class='bg-primary text-light'>";
        echo "<tr>";
        echo "<th>#</th>";
        echo "<th>Gender</th>";
        echo "<th>Age</th>";
        echo "<th>Year of Study</th>";
        echo "<th>Attendance</th>";
        echo "<th>Health Condition</th>";
        echo "<th>Lower Class</th>";
        echo "<th>Middle Class</th>";
        echo "<th>Computer Science</th>";
        echo "<th>Electrical Engineering</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        // Loop through each record and display it in the table
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['Gender'] . "</td>";
            echo "<td>" . $row['Age'] . "</td>";
            echo "<td>" . $row['Year_of_study'] . "</td>";
            echo "<td>" . $row['Attendance'] . "</td>";
            echo "<td>" . ($row['Health_condition'] == 1 ? 'Healthy' : 'Allergic') . "</td>";
            echo "<td>" . $row['Lower_Class'] . "</td>";
            echo "<td>" . $row['Middle_Class'] . "</td>";
            echo "<td>" . $row['Computer_Science'] . "</td>";
            echo "<td>" . $row['Electrical_engineering'] . "</td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
        echo "</div>";  // End of the scrollable div
    } else {
        echo "<p>No data found in the history.</p>";
    }
}
?>

                    </div>
                </div>
            </div> <!-- End of Featured Card -->

        </div> <!-- End of the row containing both cards -->
    </div> <!-- End of container -->

    <script>
        // Function to make the prediction request to Flask
        async function makePrediction() {
            // Get data from the form
            const gender = document.getElementById("gender").value;
            const age = document.getElementById("age").value;
            const year_of_study = document.getElementById("year_of_study").value;
            const attendance = document.getElementById("attendance").value;
            const health_condition = document.getElementById("health_condition").value;

            // Get Family Background values from individual fields
            const family_background_low = document.getElementById("family_background_low").value;
            const family_background_middle = document.getElementById("family_background_middle").value;

            // Get Department values from individual fields
            const department_computer_science = document.getElementById("department_computer_science").value;
            const department_electrical_engineering = document.getElementById("department_electrical_engineering").value;

            // Validate the required fields: age and attendance
            if (age === "" || attendance === "") {
                swal("Error", "Please fill in the age and attendance fields.", "error");
                return; // Stop further processing if fields are empty
            }

            // Create the data object to send to the backend
            const data = {
                "Gender": parseInt(gender),
                "Age": parseInt(age),
                "Year_of_Study": parseInt(year_of_study),
                "Attendance": parseFloat(attendance),
                "Health_Condition": parseInt(health_condition),
                "Family_Background_Low": parseInt(family_background_low),
                "Family_Background_Middle": parseInt(family_background_middle),
                "Department_Computer_Science": parseInt(department_computer_science),
                "Department_Electrical_Engineering": parseInt(department_electrical_engineering),
            };

            try {
                // Make the POST request to the Flask backend
                const response = await fetch("http://127.0.0.1:5008/predict", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(data)
                });

                // Handle the response
                if (response.ok) {
                    const result = await response.json();
                    const prediction = result.prediction[0]; // Extract the first value from the list

                    // Display SweetAlert based on prediction result
                    if (prediction === 1) {
                        swal("Success", "Prediction: Pass", "success");
                    } else {
                        swal("Failure", "Prediction: Fail", "error");
                    }

                    // Display the result in the predictionResult section
                    const resultText = prediction === 1 ? "Pass" : "Fail";
                    document.getElementById("resultText").textContent = resultText;
                    document.getElementById("predictionResult").style.display = "block";
                } else {
                    swal("Error", "Unable to fetch prediction. Please try again.", "error");
                }
            } catch (error) {
                console.error("Error:", error);
                swal("Error", "Error: " + error.message, "error");
            }
        }
    </script>

  <footer class="footer mt-3">
        <div class="container-fluid clearfix">
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center mt-3">
                <a href="https://www.rp.ac.rw/" target="_blank">Huye College</a> &copy;2025 All right Reserved
            </span>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
