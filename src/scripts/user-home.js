function updatePhilippineTimeDateAndDay() {
    const timeOptions = {
        timeZone: 'Asia/Manila',
        hour: 'numeric',
        minute: 'numeric',
        second: 'numeric',
        hour12: true
    };
    
    const dayOptions = {
        timeZone: 'Asia/Manila',
        weekday: 'long'
    };

    const dateOptions = {
        timeZone: 'Asia/Manila',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    };

    // Get current time, day, and date in Philippine timezone
    const currentTime = new Intl.DateTimeFormat('en-US', timeOptions).format(new Date());
    const currentDay = new Intl.DateTimeFormat('en-US', dayOptions).format(new Date());
    const currentDate = new Intl.DateTimeFormat('en-US', dateOptions).format(new Date());

    // Update time, day, and date elements
    document.getElementById('philippine-time').textContent = currentTime;
    document.getElementById('philippine-day').textContent = currentDay;
    document.getElementById('philippine-date').textContent = currentDate;
}

// Initial call to display the time, day, and date immediately
updatePhilippineTimeDateAndDay();
// Update the time, day, and date every second
setInterval(updatePhilippineTimeDateAndDay, 1000);
