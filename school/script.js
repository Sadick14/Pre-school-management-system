function showRegisterForm() {
    document.getElementById('login-form').style.display = 'none';
    document.getElementById('register-form').style.display = 'block';
}

function showLoginForm() {
    document.getElementById('login-form').style.display = 'block';
    document.getElementById('register-form').style.display = 'none';
}


// Example data (replace with your actual data)
const labels = ['January', 'February', 'March', 'April', 'May', 'June'];
const data = {
    labels: labels,
    datasets: [{
        label: 'Sales',
        backgroundColor: 'rgba(54, 162, 235, 0.2)',
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 1,
        data: [65, 59, 80, 81, 56, 55], // Replace with your data points
    }]
};


// Inside script.js (linked from your HTML)
document.addEventListener('DOMContentLoaded', function() {
    // Get the context of the canvas element we want to select
    var ctx = document.getElementById('myChart').getContext('2d');

    // Create the chart
    var myChart = new Chart(ctx, {
        type: 'line', // Specify the chart type
        data: data, // Pass the data object here
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});


