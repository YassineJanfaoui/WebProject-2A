function FetchDoctors(specialty) {
    // Enable the doctor dropdown only if a specialty is selected
    if (specialty) {
        $("#doctor").prop("disabled", false);

        $.ajax({
            type: 'POST',
            url: '../../controller/fetch_doctors.php',
            data: {specialty: specialty},
            success: function (response) {
                $('#doctor').html(response);
            }
        });
    } else {
        $("#doctor").prop("disabled", true).html("<option value=''>Select Doctor</option>");
        enableTimeSlots(false);
    }
}


function enableTimeSlots(isEnabled) {
    const timeSlots = document.querySelectorAll('.time-slot');
    timeSlots.forEach(slot => {
        if (isEnabled) {
            slot.classList.remove('non-clickable');
            slot.classList.add('clickable');
            slot.addEventListener('click', timeSlotClicked);
        } else {
            slot.classList.add('non-clickable');
            slot.classList.remove('clickable');
            slot.removeEventListener('click', timeSlotClicked);
        }
    });
}

function timeSlotClicked(event) {
    const clickedSlot = event.currentTarget;
    const day = clickedSlot.dataset.day;
    const time = clickedSlot.dataset.time;
    const doctor = document.getElementById('doctor').value;

    // Make an AJAX call to save the appointment
    $.ajax({
        type: 'POST',
        url: '../../controller/save_consultation.php', // Adjust the path as necessary
        data: { doctor: doctor, day: day, time: time },
        success: function(response) {
            // Handle the response here
            console.log(response);
        }
    });

    clickedSlot.classList.add('non-clickable');
    clickedSlot.classList.remove('clickable');
    clickedSlot.removeEventListener('click', timeSlotClicked);

    // Remove the class after the animation completes
    setTimeout(() => {
        clickedSlot.classList.remove('clicked-cell');
    }, 150); // 500ms matches the animation duration

    console.log(`Time slot for ${day} at ${time} clicked`);
}
// Call this function when the doctor dropdown changes
function doctorSelected(doctorDropdown) {
    // Check if a doctor has been selected
    const isDoctorSelected = doctorDropdown.value !== '';
    enableTimeSlots(isDoctorSelected);
}