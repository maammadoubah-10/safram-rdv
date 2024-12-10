var canvas = document.getElementById('myChart');
var data = JSON.parse(canvas.getAttribute('data-data'));

var ctx = canvas.getContext('2d');

var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['confirmé', 'Refusés', 'En attente'],
        datasets: [{
            label: 'Nombre de rendez-vous',
            data: [data.confirmé, data.refusés, data.en_attente],
            backgroundColor: [
                'rgba(0, 255, 0, 0.2)',  // Vert pour confirmé
                'rgba(255, 0, 0, 0.2)',  // Rouge pour refusé
                'rgba(0, 0, 255, 0.2)',  // Bleu pour en attente
            ],
            borderColor: [
                'rgba(0, 255, 0, 1)',  // Couleur du bord vert pour confirmé
                'rgba(255, 0, 0, 1)',  // Couleur du bord rouge pour refusé
                'rgba(0, 0, 255, 1)',  // Couleur du bord bleu pour en attente
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        },
        plugins: {
            legend: {
                display: false, // Masquer la légende
            },
            title: {
                display: true,
                text: 'Diagramme de Barre des rendez-vous au cours de l\'année ' + (new Date()).getFullYear(),
                position: 'bottom', // Positionnez le titre en bas du graphique
                padding: {
                    top: 40 // Ajustez cette valeur pour déplacer le titre vers le bas
                }
            },
        }
    }
});
