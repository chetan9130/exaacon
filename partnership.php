<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Submission Form</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            background-color: #fff;
            padding: 25px;
            max-width: 800px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #2c3e50;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 20px;
            font-size: 1.5em;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        .form-group input[type="text"],
        .form-group input[type="tel"],
        .form-group input[type="file"],
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1em;
        }

        .form-group textarea {
            resize: vertical;
        }

        .input-row {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
        }

        .input-row input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 12px 20px;
            cursor: pointer;
            border-radius: 6px;
            font-size: 1em;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .remove-btn {
            background-color: #dc3545;
            width: 10%;
            padding: 10px 15px;
        }

        .remove-btn:hover {
            background-color: #c82333;
        }

        .add-btn {
            display: inline-block;
            margin-top: 10px;
        }

        .submit-btn {
            display: block;
            width: 50%;
            margin: 20px auto;
            margin-top: 20px;
        }

        .section-title {
            margin-top: 30px;
            font-size: 1.3em;
            color: #2c3e50;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>General Documents</h2>
        <form action="partnership_submission.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="directorsList">List of Directors/Partners/Proprietor:</label>
                <div id="directorsContainer">
                    <div class="input-row">
                        <input type="text" name="directorName[]" placeholder="Name" required>
                        <input type="text" name="directorAddress[]" placeholder="Address" required>
                        <input type="tel" name="directorContact[]" placeholder="Contact" required>
                        <button type="button" class="remove-btn" onclick="removeRow(this)">-</button>
                    </div>
                </div>
                <button type="button" class="btn add-btn" onclick="addRow()">Add Row</button>
            </div>

            <div class="form-group">
                <label for="photoIdProof">Upload Photo ID and Address Proof:</label>
                <input type="file" id="photoIdProof" name="photoIdProof" accept=".jpg, .png, .pdf" required>
            </div>

            <div class="form-group">
                <label for="possessionProof">Proof of Possession of Premises:</label>
                <input type="file" id="possessionProof" name="possessionProof" accept=".jpg, .png, .pdf" required>
            </div>

            <div class="form-group">
                <label for="firmConstitution">Upload Firm Constitution Document:</label>
                <input type="file" id="firmConstitution" name="firmConstitution" accept=".jpg, .png, .pdf" required>
            </div>

            <div class="form-group">
                <label for="nominationClause">Nomination of Person (Clause 2.5 of FSS Rules, 2008):</label>
                <input type="file" id="nominationClause" name="nominationClause" accept=".jpg, .png, .pdf">
            </div>

            <h2 class="section-title">Additional Documents</h2>

            <div class="form-group">
                <label for="waterReport">Water Analysis Report (if applicable):</label>
                <input type="file" id="waterReport" name="waterReport" accept=".jpg, .png, .pdf">
            </div>

            <div class="form-group">
                <label for="iecDocument">Import Export Code (IEC) Document:</label>
                <input type="file" id="iecDocument" name="iecDocument" accept=".jpg, .png, .pdf">
            </div>

            <div class="form-group">
                <label for="recallPlan">Upload Recall Plan (if applicable):</label>
                <input type="file" id="recallPlan" name="recallPlan" accept=".jpg, .png, .pdf">
            </div>

            <div class="form-group">
                <label for="vehicleList">Transporter Vehicle Registration List:</label>
                <textarea id="vehicleList" name="vehicleList" rows="4" placeholder="Enter vehicle details"></textarea>
            </div>

            <button type="submit" class="btn submit-btn">Submit</button>
        </form>
    </div>

    <script>
        function addRow() {
            const container = document.getElementById('directorsContainer');
            const newRow = document.createElement('div');
            newRow.className = 'input-row';
            newRow.innerHTML = `
                <input type="text" name="directorName" placeholder="Name" required>
                <input type="text" name="directorAddress" placeholder="Address" required>
                <input type="tel" name="directorContact" placeholder="Contact" required>
                <button type="button" class="remove-btn" onclick="removeRow(this)">-</button>
            `;
            container.appendChild(newRow);
        }

        function removeRow(button) {
            const row = button.parentElement;
            row.remove();
        }
    </script>
</body>
</html>
