/**
 * Validation des horaires d'ouverture pour les commandes
 * Empêche la sélection des lundis et gère l'activation du sélecteur de créneaux
 */
document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.querySelector('input[name="commande_type[dateLivraison]"]');
    const creneauSelect = document.querySelector('select[name="commande_type[creneau]"]');
    
    if (dateInput && creneauSelect) {
        /**
         * Vérifie si une date correspond à un lundi
         * @param {string} dateString - Date au format ISO
         * @returns {boolean}
         */
        function isMonday(dateString) {
            const date = new Date(dateString);
            return date.getDay() === 1;
        }
        
        /**
         * Valide la date sélectionnée et active/désactive le créneau
         */
        function validateDate() {
            if (dateInput.value && isMonday(dateInput.value)) {
                alert('🍰 La pâtisserie est fermée le lundi. Veuillez choisir un autre jour (mardi à dimanche).');
                dateInput.value = '';
                creneauSelect.disabled = true;
                creneauSelect.value = '';
            } else if (dateInput.value) {
                creneauSelect.disabled = false;
            } else {
                creneauSelect.disabled = true;
                creneauSelect.value = '';
            }
        }
        
        // Événements de validation
        dateInput.addEventListener('change', validateDate);
        dateInput.addEventListener('input', validateDate);
        
        // État initial au chargement de la page
        validateDate();
    }
});