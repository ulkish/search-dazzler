var options = {
    type: 'date',
    labelFrom: 'Check-in',
    labelTo: 'Check-out',
    // displayMode: 'inline',
    isRange: 'true',
    closeOnSelect: 'false'
}

bulmaCalendar.attach('#checkIn', { labelFrom: 'Check-in' });
bulmaCalendar.attach('#checkOut', { labelFrom: 'Check-Out' });

var calendars = bulmaCalendar.attach('[type="date"]', options);

// Loop on each calendar initialized
for(var i = 0; i < calendars.length; i++) {
// Add listener to date:selected event
calendars[i].on('select', date => {
    console.log(date);
});
}

// To access to bulmaCalendar instance of an element
var element = document.querySelector('#my-element');
if (element) {
    // bulmaCalendar instance is available as element.bulmaCalendar
    element.bulmaCalendar.on('select', function(datepicker) {
        console.log(datepicker.data.value());
    });
}