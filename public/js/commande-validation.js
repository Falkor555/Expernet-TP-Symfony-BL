// alert('TEST - Script chargé!');

// console.log('Script commande-validation.js chargé!');

// /**
//  * Validation des horaires d'ouverture pour les commandes
//  * Empêche la sélection des lundis et gère l'activation du sélecteur de créneaux
//  */

// document.addEventListener('DOMContentLoaded', function() {
//     console.log('DOM chargé');
    
//     const dateInput = document.querySelector('[data-validate-monday="true"]');
//     const creneauSelect = document.querySelector('select[id*="creneau"]');
//     const form = dateInput ? dateInput.closest('form') : null;
//     const submitButton = form ? form.querySelector('button[type="submit"]') : null;
    
//     console.log('Éléments trouvés:', {dateInput, creneauSelect, form, submitButton});
    
//     if (!dateInput) {
//         console.error('Champ date non trouvé!');
//         return;
//     }
    
//     function showAlert(message) {
//         alert('⚠️ ' + message);
//     }
    
//     function isMonday(dateString) {
//         if (!dateString) return false;
//         const date = new Date(dateString + 'T12:00:00');
//         const day = date.getDay();
//         console.log('Vérification date:', dateString, 'jour:', day, '(1 = lundi)');
//         return day === 1;
//     }
    
//     function validateDate() {
//         const value = dateInput.value;
//         console.log('Validation:', value);
        
//         if (value && isMonday(value)) {
//             console.log('LUNDI DÉTECTÉ!');
//             showAlert('La pâtisserie est fermée le lundi. Veuillez choisir un autre jour (mardi à dimanche).');
            
//             // Vider le champ
//             dateInput.value = '';
            
//             // Désactiver le select et le bouton
//             if (creneauSelect) {
//                 creneauSelect.disabled = true;
//                 creneauSelect.value = '';
//             }
            
//             if (submitButton) {
//                 submitButton.disabled = true;
//             }
            
//             return false;
//         } else if (value && creneauSelect) {
//             creneauSelect.disabled = false;
            
//             // Réactiver le bouton si on a une date et un créneau
//             if (submitButton && creneauSelect.value) {
//                 submitButton.disabled = false;
//             }
            
//             return true;
//         } else {
//             if (creneauSelect) {
//                 creneauSelect.disabled = true;
//                 creneauSelect.value = '';
//             }
            
//             if (submitButton) {
//                 submitButton.disabled = true;
//             }
//         }
        
//         return !!value;
//     }
    
//     // Valider aussi quand le créneau change
//     if (creneauSelect) {
//         creneauSelect.addEventListener('change', function() {
//             if (submitButton) {
//                 submitButton.disabled = !dateInput.value || !creneauSelect.value;
//             }
//         });
//     }
    
//     // Événements sur la date
//     dateInput.addEventListener('change', validateDate);
//     dateInput.addEventListener('blur', validateDate);
    
//     // Double sécurité sur la soumission
//     if (form) {
//         form.addEventListener('submit', function(e) {
//             console.log('Tentative de soumission, date:', dateInput.value);
            
//             if (!dateInput.value || !creneauSelect.value) {
//                 e.preventDefault();
//                 e.stopPropagation();
//                 e.stopImmediatePropagation();
//                 showAlert('Veuillez sélectionner une date et un créneau de livraison.');
//                 return false;
//             }
            
//             if (isMonday(dateInput.value)) {
//                 e.preventDefault();
//                 e.stopPropagation();
//                 e.stopImmediatePropagation();
//                 showAlert('La pâtisserie est fermée le lundi.');
//                 dateInput.value = '';
//                 creneauSelect.disabled = true;
//                 creneauSelect.value = '';
//                 submitButton.disabled = true;
//                 return false;
//             }
//         }, true);
//     }
    
//     // Validation initiale
//     console.log('Validation initiale...');
//     if (submitButton) {
//         submitButton.disabled = true; // Désactivé par défaut
//     }
//     validateDate();
// });