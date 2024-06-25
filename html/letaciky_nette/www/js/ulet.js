var coll_menu_items = document.getElementsByClassName("menu_items");
var coll2 = document.getElementsByClassName("menu_sub_items");
var coll_logos = document.getElementsByClassName("logo_obchody_sub");
var i;

/*
Zatvorenie menu pri kliknuti na stranke mimo menu....
*/
var main = document.getElementById("main");
main.addEventListener("click", function() {
    myTelo( null , 'menu_sub');
    menuBarsMobileHidden();
    menuBarsSearchMobileHidden();
    menuBarsThemeMobileHidden();
    menuBarsSearchHidden();
});


function menuBarsMobileHidden()
{
  if (x_mobile != null)
  {
      let x = document.getElementById("menuBars");
          if (x.style.display === "block") 
          {
              x.style.display = "none";
          } 
  }
}

var x_mobile = document.getElementById("menuBarsMobile");

if (x_mobile != null)
{
    let x = document.getElementById("menuBars");
    x_mobile.addEventListener("click", function() {
        if (x.style.display === "block") 
        {
            x.style.display = "none";
        } 
        else 
        {
            menuBarsSearchMobileHidden();
            menuBarsThemeMobileHidden();
            x.style.display = "block";
        }
    });
}

function menuBarsSearchMobileHidden()
{
  if (x_mobile2 != null)
  {
    let x = document.getElementById("display_search_mobile");
    if (x.style.display === "block") 
    {
      x.style.display = "none";
    } 
  }
}

var x_mobile2 = document.getElementById("menuBarsSearch");

if (x_mobile2 != null)
{
    let x = document.getElementById("display_search_mobile");
    x_mobile2.addEventListener("click", function() {
        if (x.style.display === "block") 
        {
            x.style.display = "none";
        } 
        else 
        {
            menuBarsMobileHidden();
            menuBarsThemeMobileHidden();
            x.style.display = "block";
            var y = document.getElementById("search2").focus();
        }
    });
}



function menuBarsThemeMobileHidden()
{
  if (x_menu_mobile_theme != null)
  {
      let x = document.getElementById("menuSubTheme");
          if (x.style.display === "block") 
          {
              x.style.display = "none";
          } 
  }
}
var x_menu_mobile_theme = document.getElementById("menuThemeMobile");

if (x_menu_mobile_theme != null)
{
    let x = document.getElementById("menuSubTheme");
    x_menu_mobile_theme.addEventListener("click", function() {
        if (x.style.display === "block") 
        {
            x.style.display = "none";
        } 
        else 
        {
            menuBarsMobileHidden();
            menuBarsSearchMobileHidden();
            myTelo( null , 'menu_sub');
            x.style.display = "block";
        }
    });
}


function menuBarsSearchHidden()
{
  if (x_search != null)
  {
            let x = document.getElementById("display_search");
          if (x.style.display === "block") 
          {
              x.style.display = "none";
          } 
  }
}

var x_search = document.getElementById("search");

if (x_search != null)
{
    let x = document.getElementById("display_search");
    x_search.addEventListener("click", function() {
        if (x.style.display === "block") 
        {
            // x.style.display = "none";
        } 
        else 
        {
            menuBarsThemeHidden();
             myTelo( null , 'menu_sub');
            x.style.display = "block";
        }
    });
}


function menuBarsThemeHidden()
{
  if (x_menu_theme != null)
  {
      let x = document.getElementById("menuSubTheme");
          if (x.style.display === "block") 
          {
              x.style.display = "none";
          } 
  }
}
var x_menu_theme = document.getElementById("menuTheme");

if (x_menu_theme != null)
{
    let x = document.getElementById("menuSubTheme");
    x_menu_theme.addEventListener("click", function() {
        if (x.style.display === "block") 
        {
            x.style.display = "none";
        } 
        else 
        {
            myTelo( null , 'menu_sub');
            x.style.display = "block";
        }
    });
}

for (i = 0; i < coll_menu_items.length; i++) {
  coll_menu_items[i].addEventListener("click", function() {
    myTelo( this.id , 'menu_sub');
  });
}

for (i = 0; i < coll2.length; i++) {
  coll2[i].addEventListener("click", function() {
    myTelo( null , 'menu_sub');
  });
}


//Robal, zbal loga obchodov
for (i = 0; i < coll_logos.length; i++) {
  coll_logos[i].addEventListener("click", function() {
    myTelo2( this.id , 'logo_sub_items');
  });
}

var preview_column = document.getElementById("preview_column");
if (preview_column != null)
{
    preview_column.addEventListener("click", function() {

    var _class = 'active';
    if (preview_column.classList.contains(_class))
    {
        preview_column.classList.remove(_class);
        var _class1 = 'column';
        var _class2 = 'column_extra';
    }
    else
    {
        preview_column.classList.add(_class);
        var _class2 = 'column';
        var _class1 = 'column_extra';
    }

    var el = document.querySelectorAll('.' + _class1);          
    for(var i = el.length - 1; i >= 0; i--) 
    { 
        el[i].style.display = 'block';
    }

    var el = document.querySelectorAll('.' + _class2);          
    for(var i = el.length - 1; i >= 0; i--) 
    { 
        el[i].style.display = 'none';
    }
    });

}


 function myTelo(id, _class) {
    menuBarsThemeHidden();
    menuBarsSearchHidden();
    let block = null;
    let e = null;

    if (id != null && id != '')
    {
        e = document.getElementById('sub_'+id)
        block = e.style.display;
    }
    
    let el = document.querySelectorAll('.' + _class);          
    for(let i = el.length - 1; i >= 0; i--) 
    { 
        el[i].style.display = 'none';
    }

    if (id != null && block != null)
    {
        if (block != 'block')
        {
            e.style.display = 'block';
        }
        else
        {
            e.style.display = 'none';
        }
    }
}


 function myTelo2(id, _class) {
    let block = null;
    let e = null;
    if (id != null && id != '')
    {
        e = document.getElementById('sub_'+id)
        m = document.getElementById(id)

        if (e.classList.contains('logo_sub_active'))
        {
            e.classList.add("logo_sub_neactive");
            e.classList.remove("logo_sub_active");
            m.innerHTML = '<i class="fa fa-long-arrow-down"></i><span class="expand">' + myData.expand_next + '</span><i class="fa fa-long-arrow-down"></i>';
            m.classList.remove("expand_back");
            m.classList.add("expand_next");
        }
        else
        {
            m.innerHTML = '<i class="fa fa-long-arrow-up"></i><span class="expand">' + myData.expand_back + '</span><i class="fa fa-long-arrow-up"></i>';
            e.classList.remove("logo_sub_neactive");
            e.classList.add("logo_sub_active");

            m.classList.remove("expand_next");
            m.classList.add("expand_back");
        }
    }
}

function myTheme(id) 
{
    setCookie('theme', id, 365)
    // menuBarsThemeMobileHidden();
}

mybutton = document.getElementById("btnTop");

window.onscroll = function() {scrollFunction()};

/* ak ma aspon 20 px, tak naskoci top scrool */
function scrollFunction() { 
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
} 



function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  // document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  // var domainName = window.location.hostname;
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/; secure; domain=." + window.location.hostname;;
  console.log(window.location.hostname);

  // document.cookie = "key=value; expires=Tue, 16 Apr 2019 11:31:56 GMT; path=/; secure; domain=." + domainName;
}

function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}


// myTheme(getCookie('theme'), false)
