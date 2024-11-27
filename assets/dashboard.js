import './styles/dashboard.scss';
import { Chart } from 'chart.js/auto';

document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.getElementById('searchForm');
    const searchQuery = document.getElementById('searchQuery');
    const proprietaireFilter = document.getElementById('proprietaireFilter');
    const sortOptions = document.querySelectorAll('.sort-option');
    let currentSort = { field: 'marque', order: 'ASC' };

    // Fonction pour charger les véhicules
    async function loadVehicles() {
        const params = new URLSearchParams({
            q: searchQuery.value,
            proprietaire: proprietaireFilter.value,
            sort: currentSort.field,
            order: currentSort.order
        });

        try {
            const response = await fetch(`/api/vehicules/search?${params}`);
            const data = await response.json();
            updateTable(data);
            updateChart(data);
        } catch (error) {
            console.error('Erreur lors du chargement des véhicules:', error);
        }
    }

    // Mise à jour du tableau
    function updateTable(vehicles) {
        const tbody = document.querySelector('#vehiclesTable tbody');
        tbody.innerHTML = '';

        vehicles.forEach(vehicle => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${vehicle.marque}</td>
                <td>${vehicle.modele}</td>
                <td>${vehicle.numeroImmatriculation}</td>
                <td>${new Date(vehicle.dateImmatriculation).toLocaleDateString()}</td>
                <td>${vehicle.proprietaire.nom} ${vehicle.proprietaire.prenom}</td>
                <td>
                    <div class="btn-group">
                        <a href="/admin/vehicule/${vehicle.id}/edit" class="btn btn-sm btn-outline-primary">Éditer</a>
                        <button class="btn btn-sm btn-outline-danger" onclick="deleteVehicle(${vehicle.id})">Supprimer</button>
                    </div>
                </td>
            `;
            tbody.appendChild(tr);
        });
    }

    // Mise à jour du graphique
    function updateChart(vehicles) {
        const proprietaireStats = {};
        vehicles.forEach(vehicle => {
            const proprietaireName = `${vehicle.proprietaire.nom} ${vehicle.proprietaire.prenom}`;
            proprietaireStats[proprietaireName] = (proprietaireStats[proprietaireName] || 0) + 1;
        });

        const ctx = document.getElementById('vehiclesChart').getContext('2d');
        if (window.vehiclesChart) {
            window.vehiclesChart.destroy();
        }

        window.vehiclesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: Object.keys(proprietaireStats),
                datasets: [{
                    label: 'Nombre de véhicules',
                    data: Object.values(proprietaireStats),
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    }

    // Event listeners
    searchForm.addEventListener('input', loadVehicles);
    proprietaireFilter.addEventListener('change', loadVehicles);

    sortOptions.forEach(option => {
        option.addEventListener('click', (e) => {
            const field = e.target.dataset.sort;
            if (currentSort.field === field) {
                currentSort.order = currentSort.order === 'ASC' ? 'DESC' : 'ASC';
            } else {
                currentSort.field = field;
                currentSort.order = 'ASC';
            }
            loadVehicles();
        });
    });

    // Chargement initial
    loadVehicles();
});