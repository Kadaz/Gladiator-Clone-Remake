function switchMenu(menu)
{
    document.getElementById('submenuhead1').style.display = (menu == 1 ? 'block' : 'none');
    document.getElementById('submenu1').style.display = (menu == 1 ? 'block' : 'none');
    document.getElementById('submenuhead2').style.display = (menu == 2 ? 'block' : 'none');
    document.getElementById('submenu2').style.display = (menu == 2 ? 'block' : 'none');
    Cookie.write('menu', menu);
}