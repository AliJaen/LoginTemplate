(function llenaCalendario() {
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    const weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    const now = new Date();
    const totalDaysPreview = new Date((now.getFullYear()), (now.getMonth()), 0).getDate();
    const totalDaysCurrent = new Date((now.getFullYear()), (now.getMonth()+1), 0).getDate();
    const startMonth = new Date((now.getFullYear()), (now.getMonth()), 1).getDay();
    // Get the total weeks of month
    // If the first day isn't a sunday (0), rest the days to get the next sunday
    firstDay = startMonth === 0 ? 7 : startMonth;
    const totalWeeks = Math.ceil((totalDaysCurrent + firstDay)/7);

    const daysMonth = document.getElementById('daysMonth');

    document.getElementById('currentDate').innerHTML = now.getDate();
    document.getElementById('currentMonth').innerHTML = months[now.getMonth()];
    document.getElementById('currentDay').innerHTML = weekdays[now.getDay()-1];
    
    let start = 1;
    let nextMonth = 1;
    for (let i = 0; i < totalWeeks; i++) {
        let row = document.createElement('tr');
        row.className = 'text-center';

            for (let j = 1; j < 8; j++) {

                let day = document.createElement('td');
                day.style.fontSize = '.7em';

                if ((j < (startMonth+1)) && i < 1) {
                    day.style.color = '#B2BABB';
                    day.innerHTML = totalDaysPreview - (startMonth-j);
                } else if (start < totalDaysCurrent+1) {
                    day.innerHTML = start;
                    if (start === now.getDate()) {
                        day.style.backgroundColor = '#48C9B0';
                        day.style.color = '#FFFFFF';
                    }
                    start ++;
                } else {
                    day.style.color = '#B2BABB';
                    day.innerHTML = nextMonth;
                    nextMonth ++;
                }
                row.appendChild(day);
            }

        daysMonth.appendChild(row);
    }
})();