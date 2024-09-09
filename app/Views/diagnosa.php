<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Form Based on Checkbox Selection</title>
    <style>
       body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            max-width: 800px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-top: 50px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group input[type="radio"] {
            margin-right: 10px;
        }
        .form-group label {
            margin-right: 20px;
        }
        button {
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            opacity: 0.9;
        }
        .submit-button {
            background-color: #007BFF;
            color: #fff;
        }
        .submit-button:disabled {
            background-color: #c0c0c0;
            cursor: not-allowed;
        }
        .results {
            margin-top: 20px;
        }
        .results .result-item {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }
        .new-form {
            margin-top: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Diagnosis</h1>
    <form id="optionsForm">
        <div class="form-group">
            <?php foreach ($gejala as $item): ?>
                <input type="radio" id="<?= $item['id_gejala']; ?>" name="gejala" value="<?= $item['id_gejala']; ?>"
                       data-masalah="<?= htmlspecialchars($item['Masalah']); ?>"
                       data-solusi="<?= htmlspecialchars($item['Solusi']); ?>">
                <label for="<?= $item['id_gejala']; ?>">
                    <?= $item['Kode'] . ' | ' . $item['NamaG']; ?>
                </label><br>
            <?php endforeach; ?>
        </div>
        <button type="button" class="submit-button" id="submitButton" onclick="submitForm()">Submit</button>
    </form>
    <div id="newFormsContainer"></div> <!-- Container for new forms -->
</div>

<script>
    function submitForm() {
        // Get the selected radio button value
        const selectedOption = document.querySelector('input[name="gejala"]:checked');
        
        if (selectedOption) {
            const selectedId = selectedOption.value;
            console.log('Selected id_gejala: ' + selectedId);  // Show the selected id_gejala in the console

            // Extract data attributes
            const masalahNama = selectedOption.getAttribute('data-masalah') || 'Default Masalah';
            const solusiNama = selectedOption.getAttribute('data-solusi') || 'Default Solusi';

            // Create a new form element
            const newFormContainer = document.getElementById('newFormsContainer');
            const newForm = document.createElement('form');

            newForm.className = 'new-form';
            newForm.innerHTML = `
                <label for="totalMasalah">Masalah:</label>
                <input type="text" class="form-control" id="totalMasalah" name="totalMasalah" value="${masalahNama}" readonly><br>
                <label for="totalSolusi">Solusi:</label>
                <input type="text" class="form-control" id="totalSolusi" name="totalSolusi" value="${solusiNama}" readonly>
            `;

            newFormContainer.appendChild(newForm);
        } 
    }

    function submitNewForm(button) {
        // Example function for handling new form submissions
        const newForm = button.closest('form');  // Find the closest form element
        const totalMasalahInput = newForm.querySelector('input[name="totalMasalah"]').value;
        const totalSolusiInput = newForm.querySelector('input[name="totalSolusi"]').value;
        alert('New form inputs:\nMasalah: ' + totalMasalahInput + '\nSolusi: ' + totalSolusiInput);
    }
</script>
</body>
</html>