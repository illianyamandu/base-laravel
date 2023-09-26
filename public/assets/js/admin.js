// Start: Sidebar
const sidebarToggle = document.querySelector('.sidebar-toggle');
const sidebarOverlay = document.querySelector('.sidebar-overlay');
const sidebarMenu = document.querySelector('.sidebar-menu');
const main = document.querySelector('.main');

sidebarToggle.addEventListener('click', function (e) {
    e.preventDefault();
    
    main.classList.toggle('active');
    sidebarOverlay.classList.toggle('hidden');
    sidebarMenu.classList.toggle('-translate-x-full');
});

sidebarOverlay.addEventListener('click', function (e) {
    e.preventDefault();
    
    main.classList.add('active');
    sidebarOverlay.classList.toggle('hidden');
    sidebarMenu.classList.toggle('-translate-x-full');
});

document.querySelectorAll('.sidebar-dropdown-toggle').forEach(function (item) {
    item.addEventListener('click', function(e){
        e.preventDefault();
        const parent = item.closest('.group');
        
        if (parent.classList.contains('selected')) {
            parent.classList.remove('selected'); 
        } else {
            document.querySelectorAll('.sidebar-dropdown-toggle').forEach(function (i) {
                i.closest('.group').classList.remove('selected');
            });
            parent.classList.add('selected');
        }
    });
});
// End: Sidebar

// Start: Popper
const popperInstance = {};
document.querySelectorAll('.dropdown').forEach(function (item, index) {
    const popperId = 'popper-' + index;
    const toggle = item.querySelector('.dropdown-toggle');
    const menu = item.querySelector('.dropdown-menu');
    menu.dataset.popperId = popperId;
    popperInstance[popperId] = Popper.createPopper(toggle, menu, {
        modifiers: [
            {
                name: 'offset',
                options: {
                    offset: [0, 8],
                },
            },
            {
                name: 'preventOverflow',
                options: {
                    padding: 0,
                },
            }
        ],
        placement: 'bottom-end',
    });
});

document.addEventListener('click', function (e) {
    const toggle = e.target.closest('.dropdown-toggle');
    const menu = e.target.closest('.dropdown-menu');
    
    if (toggle) {
        const menuEl = toggle.closest('.dropdown').querySelector('.dropdown-menu');
        const propperId = menuEl.dataset.popperId;
        if (menuEl.classList.contains('hidden')) {
            hideDropdown();
            menuEl.classList.remove('hidden');
            showPopper(propperId);
        } else {
            menuEl.classList.add('hidden');
            hidePopper(propperId);
        }
    } else if (!menu){
        hideDropdown();
    }
});

function hideDropdown(){
    document.querySelectorAll('.dropdown-menu').forEach(function(item){
        item.classList.add('hidden');
    });
}

function showPopper(popperId) {
    popperInstance[popperId].setOptions(function (options) {
        return {
        ...options,
        modifiers: [
            ...options.modifiers,
            { name: 'eventListeners', enabled: true },
        ],
        }
    });

    popperInstance[popperId].update();
}

function hidePopper(popperId) {
    popperInstance[popperId].setOptions(function (options) {
        return {
        ...options,
        modifiers: [
            ...options.modifiers,
            { name: 'eventListeners', enabled: false },
        ],
        }
    });
}
// End: Popper

// Start: Tab
document.querySelectorAll('[data-tab]').forEach(function (item) {
    item.addEventListener('click', function (e) {
        e.preventDefault();
        const tab = item.dataset.tab;
        const page = item.dataset.tabPage;
        const target = document.querySelector('[data-tab-for="' + tab + '"][data-page="' + page + '"]');
        document.querySelectorAll('[data-tab="' + tab + '"]').forEach(function (i) {
            i.classList.remove('active');
        });
        document.querySelectorAll('[data-tab-for="' + tab + '"]').forEach(function (i) {
            i.classList.add('hidden');
        });
        item.classList.add('active');
        target.classList.remove('hidden');
    });
});
// End: Tab

// Start: Chart
new Chart(document.getElementById('order-chart'), {
    type: 'line',
    data: {
      labels: generateNDays(7),
      datasets: [{
        label: '# of Votes',
        data: generateRandomData(7),
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
});

function generateNDays(n){
    const data  = [];
    for(let i = 0; i < n; i++){
        const date = new Date();
        date.setDate(date.getDate() - i);
        data.push(date.toLocaleDateString('en-US', { 
            month: 'short', 
            day: 'numeric' 
        }));
    }
    return data;
}

function generateRandomData(n){
    const data  = [];
    for(let i = 0; i < n; i++){
        data.push(Math.round(Math.random() * 10));
    }
}
// End: Chart