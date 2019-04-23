<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js"></script>
<script>
var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
	type: 'bar',
	data: {
		labels: ['1 Minggu', '1 Bulan', '2 Minggu', 'Melewati'],
		datasets: [{
			label: ['Data'],
			data: [<?= $Adendum['seminggu'] ?>, <?= $Adendum['sebulan']?>, <?= $Adendum['duaminggu'] ?>, <?= $Adendum['melewati'] ?>],
			backgroundColor: [
				'rgba(255, 99, 132, 0.2)',
				'rgba(54, 162, 235, 0.2)',
				'rgba(255, 206, 86, 0.2)',
				'rgba(75, 192, 192, 0.2)'
			],
			borderColor: [
				'rgba(255, 99, 132, 1)',
				'rgba(54, 162, 235, 1)',
				'rgba(255, 206, 86, 1)',
				'rgba(75, 192, 192, 1)'
			],
			borderWidth: 1
		}]
	},
	options: {
		legend: { display: false },
		scales: {
			yAxes: [{
				ticks: {
					beginAtZero: true
				}
			}]
		}
	}
});
</script>