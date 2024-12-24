<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcode Allotment Document Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            max-width: 600px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        select, input[type="file"], button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #007BFF;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .hidden {
            display: none;
        }

        .section {
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 15px;
        }
    </style>
</head>
<body>
    <h1>Barcode Allotment Document Submission</h1>
    <form id="barcodeForm" action="barcode_submission.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="form_name" value="Barcode Document Submission">
        <div class="section">
            <label for="companyType">Select Company Type:</label>
            <select id="companyType" name="companyType" onchange="showFields()">
                <option value="">--Select--</option>
                <option value="proprietorship">Proprietorship Firm</option>
                <option value="partnership">Partnership Firm</option>
                <option value="pvtLtd">Private/Public Ltd. Company</option>
                <option value="other">Other Entities (e.g., Registered Society, HUF)</option>
            </select>
        </div>

        <div class="section">
            <label for="panCard">Upload PAN Card:</label>
            <input type="file" id="panCard" name="panCard" required>

            <label for="balanceSheet">Upload Balance Sheet:</label>
            <input type="file" id="balanceSheet" name="balanceSheet" required>

            <label for="barcodeRequestLetter">Upload Company Letter Requesting Barcode Allotment:</label>
            <input type="file" id="barcodeRequestLetter" name="barcodeRequestLetter" required>
        </div>

        <div id="proprietorshipFields" class="section hidden">
            <label for="proprietorshipProof">Upload GST/VAT Registration Certificate:</label>
            <input type="file" id="proprietorshipProof" name="proprietorshipProof">
        </div>

        <div id="partnershipFields" class="section hidden">
            <label for="partnershipProof">Upload GST/VAT Registration Certificate or Partnership Deed:</label>
            <input type="file" id="partnershipProof" name="partnershipProof">
        </div>

        <div id="pvtLtdFields" class="section hidden">
            <label for="gstCertificate">Upload GST/VAT Registration Certificate:</label>
            <input type="file" id="gstCertificate" name="gstCertificate">

            <label for="rocCertificate">Upload ROC Certificate or Memorandum of Association (MOA):</label>
            <input type="file" id="rocCertificate" name="rocCertificate">
        </div>

        <div id="otherFields" class="section hidden">
            <label for="otherProof">Upload GST/VAT Registration Certificate or Registrar of Society (ROS) Certificate:</label>
            <input type="file" id="otherProof" name="otherProof">
        </div>

        <div class="section">
            <label for="cancelledCheque">Upload Cancelled Cheque Copy:</label>
            <input type="file" id="cancelledCheque" name="cancelledCheque" required>
        </div>

        <button type="submit">Submit</button>
    </form>

    <script>
        function showFields() {
            const companyType = document.getElementById('companyType').value;

            // Hide all dynamic sections
            document.getElementById('proprietorshipFields').classList.add('hidden');
            document.getElementById('partnershipFields').classList.add('hidden');
            document.getElementById('pvtLtdFields').classList.add('hidden');
            document.getElementById('otherFields').classList.add('hidden');

            // Show relevant fields based on selection
            if (companyType === 'proprietorship') {
                document.getElementById('proprietorshipFields').classList.remove('hidden');
            } else if (companyType === 'partnership') {
                document.getElementById('partnershipFields').classList.remove('hidden');
            } else if (companyType === 'pvtLtd') {
                document.getElementById('pvtLtdFields').classList.remove('hidden');
            } else if (companyType === 'other') {
                document.getElementById('otherFields').classList.remove('hidden');
            }
        }
    </script>
</body>
</html>
