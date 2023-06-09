


const navItems = document.getElementsByClassName('nav-item');

for (let i = 0; i < navItems.length; i++) {
    
    navItems[i].addEventListener('click', () => {
        for (let j = 0; j < navItems.length; j++)
            navItems[j].classList.remove('active');
            document.getElementById('wall').style.display = 'flex';
        navItems[i].classList.add('active');
        window.location.href=navItems[i].id;
    });
}