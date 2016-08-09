<?php

require_once('ClientBundle/views/layout/header.php');

?>
<style>

.container {
    background-color: #f5f4f2;
    color: white;
    float: left;
    font-family: "Quicksand";
}

.col {
    float: left;
    max-width:280px;
    background-color: #262626;
    vertical-align: middle;
    text-align: center;
    margin: 25px 10px 10px 25px;
    overflow: hidden;

    display: table-cell;
}

.col img {
    max-width: 80%;
}

.col h2 {
    margin: 5px 0 5px 0;
}

.col a {
    text-decoration: none;
    color: white;
}

.col p {
    text-align: left;
}

table {
    color: white;
    padding: 5px;
}

th {
    text-align: right;
    white-space: nowrap;
    vertical-align: top;
}

.hvr-grow {
  display: inline-block;
  vertical-align: middle;
  -webkit-transform: translateZ(0);
  transform: translateZ(0);
  box-shadow: 0 0 1px rgba(0, 0, 0, 0);
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
  -moz-osx-font-smoothing: grayscale;
  -webkit-transition-duration: 0.3s;
  transition-duration: 0.3s;
  -webkit-transition-property: transform;
  transition-property: transform;
}
.hvr-grow:hover, .hvr-grow:focus, .hvr-grow:active {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}

.title_div {
    width: 100%;
    background-color: #404040;
    height: 30px;
    vertical-align: center;
    margin: 0 0 15px 0;
}

.title_div span {
    font-size: 1.0em;
}

.title_div h2 {
    margin-top: 0;
    padding-top: 1px;
}

.clear_div {
    clear: both;
}

.more_info_div {
    width: 100%;
    background-color: #404040;
    height: 30px;
    vertical-align: center;
}

.more_info_div span {
    font-size: 1.4em;
}

.hidden_info {
    display: none;
}

</style>

<script>

$( document ).ready(function() {
    $('.more_info_div').click(function() {
        console.log( $(this).find('.hidden_info'));
        $(this).find('.hidden_info').css('display', 'initial');
    })
});

</script>

<div class="container">
	<div class="col hvr-grow">
        <div class="title_div"><span><h2>Web Design</h2></span></div>
    	<img src="ClientBundle/ressources/folder_page/img/service-img1.jpg" />
        <table id="vertical-1">
            <tr>
                <th>Titre :</th>
                <td>La rose des ventsLa rose des ventsLa rose des vents</td>
            </tr>
            <tr>
                <th>Sous-titre :</th>
                <td>Fast and furious</td>
            </tr>
            <tr>
                <th>Descriptif :</th>
                <td>film de voiture</td>
            </tr>
            <tr>
                <th>Auteur :</th>
                <td>jenesaispas</td>
            </tr>
            <tr class="hidden_info">
                <th>Titre :</th>
                <td>La rose des ventsLa rose des ventsLa rose des vents</td>
            </tr>
            <tr class="hidden_info">
                <th>Sous-titre :</th>
                <td>Fast and furious</td>
            </tr>
            <tr class="hidden_info">
                <th>Descriptif :</th>
                <td>film de voiture</td>
            </tr>
            <tr class="hidden_info">
                <th>Auteur :</th>
                <td>jenesaispas</td>
            </tr>
        </table>

        <div class="clear_div"></div>
        <div class="more_info_div" style="" ><span>+</span></div>
    </div>

    <div class="col hvr-grow">
        <div class="title_div"><span><h2>Web Development</h2></span></div>
        <img src="ClientBundle/ressources/folder_page/img/service-img2.jpg" />
        <table id="vertical-1">
            <tr>
                <th>Titre :</th>
                <td>La rose des ventsLa rose des ventsLa rose des vents</td>
            </tr>
            <tr>
                <th>Sous-titre :</th>
                <td>Fast and furious</td>
            </tr>
            <tr>
                <th>Descriptif :</th>
                <td>film de voiture</td>
            </tr>
            <tr>
                <th>Auteur :</th>
                <td>jenesaispas</td>
            </tr>
        </table>

        <div class="clear_div"></div>
        <div class="more_info_div" style="" ><span>+</span></div>
    </div>

    <div class="col hvr-grow">
        <div class="title_div"><span><h2>SEO</h2></span></div>
        <img src="ClientBundle/ressources/folder_page/img/service-img3.jpg" />
        <table id="vertical-1">
            <tr>
                <th>Titre :</th>
                <td>La rose des ventsLa rose des ventsLa rose des vents</td>
            </tr>
            <tr>
                <th>Sous-titre :</th>
                <td>Fast and furious</td>
            </tr>
            <tr>
                <th>Descriptif :</th>
                <td>film de voiture</td>
            </tr>
            <tr>
                <th>Auteur :</th>
                <td>jenesaispas</td>
            </tr>
        </table>

        <div class="clear_div"></div>
        <div class="more_info_div" style="" ><span>+</span></div>
    </div>

    <div class="col hvr-grow">
        <div class="title_div"><span><h2>Graphics Design</h2></span></div>
        <img src="ClientBundle/ressources/folder_page/img/service-img4.jpg" />
        <table id="vertical-1">
            <tr>
                <th>Titre :</th>
                <td>La rose des ventsLa rose des ventsLa rose des vents</td>
            </tr>
            <tr>
                <th>Sous-titre :</th>
                <td>Fast and furious</td>
            </tr>
            <tr>
                <th>Descriptif :</th>
                <td>film de voiture</td>
            </tr>
            <tr>
                <th>Auteur :</th>
                <td>jenesaispas</td>
            </tr>
        </table>

        <div class="clear_div"></div>
        <div class="more_info_div" style="" ><span>+</span></div>
    </div>
    <div class="col hvr-grow">
        <div class="title_div"><span><h2>Web Design</h2></span></div>
        <img src="ClientBundle/ressources/folder_page/img/service-img1.jpg" />
        <table id="vertical-1">
            <tr>
                <th>Titre :</th>
                <td>La rose des ventsLa rose des ventsLa rose des vents</td>
            </tr>
            <tr>
                <th>Sous-titre :</th>
                <td>Fast and furious</td>
            </tr>
            <tr>
                <th>Descriptif :</th>
                <td>film de voiture</td>
            </tr>
            <tr>
                <th>Auteur :</th>
                <td>jenesaispas</td>
            </tr>
        </table>

        <div class="clear_div"></div>
        <div class="more_info_div" style="" ><span>+</span></div>
    </div>

    <div class="col hvr-grow">
        <div class="title_div"><span><h2>Web Development</h2></span></div>
        <img src="ClientBundle/ressources/folder_page/img/service-img2.jpg" />
        <table id="vertical-1">
            <tr>
                <th>Titre :</th>
                <td>La rose des ventsLa rose des ventsLa rose des vents</td>
            </tr>
            <tr>
                <th>Sous-titre :</th>
                <td>Fast and furious</td>
            </tr>
            <tr>
                <th>Descriptif :</th>
                <td>film de voiture</td>
            </tr>
            <tr>
                <th>Auteur :</th>
                <td>jenesaispas</td>
            </tr>
        </table>

        <div class="clear_div"></div>
        <div class="more_info_div" style="" ><span>+</span></div>
    </div>

    <div class="col hvr-grow">
        <div class="title_div"><span><h2>SEO</h2></span></div>
        <img src="ClientBundle/ressources/folder_page/img/service-img3.jpg" />
        <table id="vertical-1">
            <tr>
                <th>Titre :</th>
                <td>La rose des ventsLa rose des ventsLa rose des vents</td>
            </tr>
            <tr>
                <th>Sous-titre :</th>
                <td>Fast and furious</td>
            </tr>
            <tr>
                <th>Descriptif :</th>
                <td>film de voiture</td>
            </tr>
            <tr>
                <th>Auteur :</th>
                <td>jenesaispas</td>
            </tr>
        </table>

        <div class="clear_div"></div>
        <div class="more_info_div" style="" ><span>+</span></div>
    </div>

    <div class="col hvr-grow">
        <div class="title_div"><span><h2>Graphics Design</h2></span></div>
        <img src="ClientBundle/ressources/folder_page/img/service-img4.jpg" />
        <table id="vertical-1">
            <tr>
                <th>Titre :</th>
                <td>La rose des ventsLa rose des ventsLa rose des vents</td>
            </tr>
            <tr>
                <th>Sous-titre :</th>
                <td>Fast and furious</td>
            </tr>
            <tr>
                <th>Descriptif :</th>
                <td>film de voiture</td>
            </tr>
            <tr>
                <th>Auteur :</th>
                <td>jenesaispas</td>
            </tr>
        </table>

        <div class="clear_div"></div>
        <div class="more_info_div" style="" ><span>+</span></div>
    </div>
    <div class="col hvr-grow">
        <div class="title_div"><span><h2>Web Design</h2></span></div>
        <img src="ClientBundle/ressources/folder_page/img/service-img1.jpg" />
        <table id="vertical-1">
            <tr>
                <th>Titre :</th>
                <td>La rose des ventsLa rose des ventsLa rose des vents</td>
            </tr>
            <tr>
                <th>Sous-titre :</th>
                <td>Fast and furious</td>
            </tr>
            <tr>
                <th>Descriptif :</th>
                <td>film de voiture</td>
            </tr>
            <tr>
                <th>Auteur :</th>
                <td>jenesaispas</td>
            </tr>
        </table>

        <div class="clear_div"></div>
        <div class="more_info_div" style="" ><span>+</span></div>
    </div>

    <div class="col hvr-grow">
        <div class="title_div"><span><h2>Web Development</h2></span></div>
        <img src="ClientBundle/ressources/folder_page/img/service-img2.jpg" />
        <table id="vertical-1">
            <tr>
                <th>Titre :</th>
                <td>La rose des ventsLa rose des ventsLa rose des vents</td>
            </tr>
            <tr>
                <th>Sous-titre :</th>
                <td>Fast and furious</td>
            </tr>
            <tr>
                <th>Descriptif :</th>
                <td>film de voiture</td>
            </tr>
            <tr>
                <th>Auteur :</th>
                <td>jenesaispas</td>
            </tr>
        </table>

        <div class="clear_div"></div>
        <div class="more_info_div" style="" ><span>+</span></div>
    </div>

    <div class="col hvr-grow">
        <div class="title_div"><span><h2>SEO</h2></span></div>
        <img src="ClientBundle/ressources/folder_page/img/service-img3.jpg" />
        <table id="vertical-1">
            <tr>
                <th>Titre :</th>
                <td>La rose des ventsLa rose des ventsLa rose des vents</td>
            </tr>
            <tr>
                <th>Sous-titre :</th>
                <td>Fast and furious</td>
            </tr>
            <tr>
                <th>Descriptif :</th>
                <td>film de voiture</td>
            </tr>
            <tr>
                <th>Auteur :</th>
                <td>jenesaispas</td>
            </tr>
        </table>

        <div class="clear_div"></div>
        <div class="more_info_div" style="" ><span>+</span></div>
    </div>

    <div class="col hvr-grow">
        <div class="title_div"><span><h2>Graphics Design</h2></span></div>
        <img src="ClientBundle/ressources/folder_page/img/service-img4.jpg" />
        <table id="vertical-1">
            <tr>
                <th>Titre :</th>
                <td>La rose des ventsLa rose des ventsLa rose des vents</td>
            </tr>
            <tr>
                <th>Sous-titre :</th>
                <td>Fast and furious</td>
            </tr>
            <tr>
                <th>Descriptif :</th>
                <td>film de voiture</td>
            </tr>
            <tr>
                <th>Auteur :</th>
                <td>jenesaispas</td>
            </tr>
        </table>

        <div class="clear_div"></div>
        <div class="more_info_div" style="" ><span>+</span></div>
    </div>
    <div class="col hvr-grow">
        <div class="title_div"><span><h2>Web Design</h2></span></div>
        <img src="ClientBundle/ressources/folder_page/img/service-img1.jpg" />
        <table id="vertical-1">
            <tr>
                <th>Titre :</th>
                <td>La rose des ventsLa rose des ventsLa rose des vents</td>
            </tr>
            <tr>
                <th>Sous-titre :</th>
                <td>Fast and furious</td>
            </tr>
            <tr>
                <th>Descriptif :</th>
                <td>film de voiture</td>
            </tr>
            <tr>
                <th>Auteur :</th>
                <td>jenesaispas</td>
            </tr>
        </table>

        <div class="clear_div"></div>
        <div class="more_info_div" style="" ><span>+</span></div>
    </div>

    <div class="col hvr-grow">
        <div class="title_div"><span><h2>Web Development</h2></span></div>
        <img src="ClientBundle/ressources/folder_page/img/service-img2.jpg" />
        <table id="vertical-1">
            <tr>
                <th>Titre :</th>
                <td>La rose des ventsLa rose des ventsLa rose des vents</td>
            </tr>
            <tr>
                <th>Sous-titre :</th>
                <td>Fast and furious</td>
            </tr>
            <tr>
                <th>Descriptif :</th>
                <td>film de voiture</td>
            </tr>
            <tr>
                <th>Auteur :</th>
                <td>jenesaispas</td>
            </tr>
        </table>

        <div class="clear_div"></div>
        <div class="more_info_div" style="" ><span>+</span></div>
    </div>

    <div class="col hvr-grow">
        <div class="title_div"><span><h2>SEO</h2></span></div>
        <img src="ClientBundle/ressources/folder_page/img/service-img3.jpg" />
        <table id="vertical-1">
            <tr>
                <th>Titre :</th>
                <td>La rose des ventsLa rose des ventsLa rose des vents</td>
            </tr>
            <tr>
                <th>Sous-titre :</th>
                <td>Fast and furious</td>
            </tr>
            <tr>
                <th>Descriptif :</th>
                <td>film de voiture</td>
            </tr>
            <tr>
                <th>Auteur :</th>
                <td>jenesaispas</td>
            </tr>
        </table>

        <div class="clear_div"></div>
        <div class="more_info_div" style="" ><span>+</span></div>
    </div>

    <div class="col hvr-grow">
        <div class="title_div"><span><h2>Graphics Design</h2></span></div>
        <img src="ClientBundle/ressources/folder_page/img/service-img4.jpg" />
        <table id="vertical-1">
            <tr>
                <th>Titre :</th>
                <td>La rose des ventsLa rose des ventsLa rose des vents</td>
            </tr>
            <tr>
                <th>Sous-titre :</th>
                <td>Fast and furious</td>
            </tr>
            <tr>
                <th>Descriptif :</th>
                <td>film de voiture</td>
            </tr>
            <tr>
                <th>Auteur :</th>
                <td>jenesaispas</td>
            </tr>
        </table>

        <div class="clear_div"></div>
        <div class="more_info_div" style="" ><span>+</span></div>
    </div>
    <div class="col hvr-grow">
        <div class="title_div"><span><h2>Web Design</h2></span></div>
        <img src="ClientBundle/ressources/folder_page/img/service-img1.jpg" />
        <table id="vertical-1">
            <tr>
                <th>Titre :</th>
                <td>La rose des ventsLa rose des ventsLa rose des vents</td>
            </tr>
            <tr>
                <th>Sous-titre :</th>
                <td>Fast and furious</td>
            </tr>
            <tr>
                <th>Descriptif :</th>
                <td>film de voiture</td>
            </tr>
            <tr>
                <th>Auteur :</th>
                <td>jenesaispas</td>
            </tr>
        </table>

        <div class="clear_div"></div>
        <div class="more_info_div" style="" ><span>+</span></div>
    </div>

    <div class="col hvr-grow">
        <div class="title_div"><span><h2>Web Development</h2></span></div>
        <img src="ClientBundle/ressources/folder_page/img/service-img2.jpg" />
        <table id="vertical-1">
            <tr>
                <th>Titre :</th>
                <td>La rose des ventsLa rose des ventsLa rose des vents</td>
            </tr>
            <tr>
                <th>Sous-titre :</th>
                <td>Fast and furious</td>
            </tr>
            <tr>
                <th>Descriptif :</th>
                <td>film de voiture</td>
            </tr>
            <tr>
                <th>Auteur :</th>
                <td>jenesaispas</td>
            </tr>
        </table>

        <div class="clear_div"></div>
        <div class="more_info_div" style="" ><span>+</span></div>
    </div>

    <div class="col hvr-grow">
        <div class="title_div"><span><h2>SEO</h2></span></div>
        <img src="ClientBundle/ressources/folder_page/img/service-img3.jpg" />
        <table id="vertical-1">
            <tr>
                <th>Titre :</th>
                <td>La rose des ventsLa rose des ventsLa rose des vents</td>
            </tr>
            <tr>
                <th>Sous-titre :</th>
                <td>Fast and furious</td>
            </tr>
            <tr>
                <th>Descriptif :</th>
                <td>film de voiture</td>
            </tr>
            <tr>
                <th>Auteur :</th>
                <td>jenesaispas</td>
            </tr>
        </table>

        <div class="clear_div"></div>
        <div class="more_info_div" style="" ><span>+</span></div>
    </div>

    <div class="col hvr-grow">
        <div class="title_div"><span><h2>Graphics Design</h2></span></div>
        <img src="ClientBundle/ressources/folder_page/img/service-img4.jpg" />
        <table id="vertical-1">
            <tr>
                <th>Titre :</th>
                <td>La rose des ventsLa rose des ventsLa rose des vents</td>
            </tr>
            <tr>
                <th>Sous-titre :</th>
                <td>Fast and furious</td>
            </tr>
            <tr>
                <th>Descriptif :</th>
                <td>film de voiture</td>
            </tr>
            <tr>
                <th>Auteur :</th>
                <td>jenesaispas</td>
            </tr>
        </table>

        <div class="clear_div"></div>
        <div class="more_info_div" style="" ><span>+</span></div>
    </div>
    <div class="col hvr-grow">
        <div class="title_div"><span><h2>Web Design</h2></span></div>
        <img src="ClientBundle/ressources/folder_page/img/service-img1.jpg" />
        <table id="vertical-1">
            <tr>
                <th>Titre :</th>
                <td>La rose des ventsLa rose des ventsLa rose des vents</td>
            </tr>
            <tr>
                <th>Sous-titre :</th>
                <td>Fast and furious</td>
            </tr>
            <tr>
                <th>Descriptif :</th>
                <td>film de voiture</td>
            </tr>
            <tr>
                <th>Auteur :</th>
                <td>jenesaispas</td>
            </tr>
        </table>

        <div class="clear_div"></div>
        <div class="more_info_div" style="" ><span>+</span></div>
    </div>

    <div class="col hvr-grow">
        <div class="title_div"><span><h2>Web Development</h2></span></div>
        <img src="ClientBundle/ressources/folder_page/img/service-img2.jpg" />
        <table id="vertical-1">
            <tr>
                <th>Titre :</th>
                <td>La rose des ventsLa rose des ventsLa rose des vents</td>
            </tr>
            <tr>
                <th>Sous-titre :</th>
                <td>Fast and furious</td>
            </tr>
            <tr>
                <th>Descriptif :</th>
                <td>film de voiture</td>
            </tr>
            <tr>
                <th>Auteur :</th>
                <td>jenesaispas</td>
            </tr>
        </table>

        <div class="clear_div"></div>
        <div class="more_info_div" style="" ><span>+</span></div>
    </div>

    <div class="col hvr-grow">
        <div class="title_div"><span><h2>SEO</h2></span></div>
        <img src="ClientBundle/ressources/folder_page/img/service-img3.jpg" />
        <table id="vertical-1">
            <tr>
                <th>Titre :</th>
                <td>La rose des ventsLa rose des ventsLa rose des vents</td>
            </tr>
            <tr>
                <th>Sous-titre :</th>
                <td>Fast and furious</td>
            </tr>
            <tr>
                <th>Descriptif :</th>
                <td>film de voiture</td>
            </tr>
            <tr>
                <th>Auteur :</th>
                <td>jenesaispas</td>
            </tr>
        </table>

        <div class="clear_div"></div>
        <div class="more_info_div" style="" ><span>+</span></div>
    </div>

    <div class="col hvr-grow">
        <div class="title_div"><span><h2>Graphics Design</h2></span></div>
        <img src="ClientBundle/ressources/folder_page/img/service-img4.jpg" />
        <table id="vertical-1">
            <tr>
                <th>Titre :</th>
                <td>La rose des ventsLa rose des ventsLa rose des vents</td>
            </tr>
            <tr>
                <th>Sous-titre :</th>
                <td>Fast and furious</td>
            </tr>
            <tr>
                <th>Descriptif :</th>
                <td>film de voiture</td>
            </tr>
            <tr>
                <th>Auteur :</th>
                <td>jenesaispas</td>
            </tr>
        </table>

        <div class="clear_div"></div>
        <div class="more_info_div" style="" ><span>+</span></div>
    </div>
    <div class="col hvr-grow">
        <div class="title_div"><span><h2>Web Design</h2></span></div>
        <img src="ClientBundle/ressources/folder_page/img/service-img1.jpg" />
        <table id="vertical-1">
            <tr>
                <th>Titre :</th>
                <td>La rose des ventsLa rose des ventsLa rose des vents</td>
            </tr>
            <tr>
                <th>Sous-titre :</th>
                <td>Fast and furious</td>
            </tr>
            <tr>
                <th>Descriptif :</th>
                <td>film de voiture</td>
            </tr>
            <tr>
                <th>Auteur :</th>
                <td>jenesaispas</td>
            </tr>
        </table>

        <div class="clear_div"></div>
        <div class="more_info_div" style="" ><span>+</span></div>
    </div>

    <div class="col hvr-grow">
        <div class="title_div"><span><h2>Web Development</h2></span></div>
        <img src="ClientBundle/ressources/folder_page/img/service-img2.jpg" />
        <table id="vertical-1">
            <tr>
                <th>Titre :</th>
                <td>La rose des ventsLa rose des ventsLa rose des vents</td>
            </tr>
            <tr>
                <th>Sous-titre :</th>
                <td>Fast and furious</td>
            </tr>
            <tr>
                <th>Descriptif :</th>
                <td>film de voiture</td>
            </tr>
            <tr>
                <th>Auteur :</th>
                <td>jenesaispas</td>
            </tr>
        </table>

        <div class="clear_div"></div>
        <div class="more_info_div" style="" ><span>+</span></div>
    </div>

    <div class="col hvr-grow">
        <div class="title_div"><span><h2>SEO</h2></span></div>
        <img src="ClientBundle/ressources/folder_page/img/service-img3.jpg" />
        <table id="vertical-1">
            <tr>
                <th>Titre :</th>
                <td>La rose des ventsLa rose des ventsLa rose des vents</td>
            </tr>
            <tr>
                <th>Sous-titre :</th>
                <td>Fast and furious</td>
            </tr>
            <tr>
                <th>Descriptif :</th>
                <td>film de voiture</td>
            </tr>
            <tr>
                <th>Auteur :</th>
                <td>jenesaispas</td>
            </tr>
        </table>

        <div class="clear_div"></div>
        <div class="more_info_div" style="" ><span>+</span></div>
    </div>

    <div class="col hvr-grow">
        <div class="title_div"><span><h2>Graphics Design</h2></span></div>
        <img src="ClientBundle/ressources/folder_page/img/service-img4.jpg" />
        <table id="vertical-1">
            <tr>
                <th>Titre :</th>
                <td>La rose des ventsLa rose des ventsLa rose des vents</td>
            </tr>
            <tr>
                <th>Sous-titre :</th>
                <td>Fast and furious</td>
            </tr>
            <tr>
                <th>Descriptif :</th>
                <td>film de voiture</td>
            </tr>
            <tr>
                <th>Auteur :</th>
                <td>jenesaispas</td>
            </tr>
        </table>

        <div class="clear_div"></div>
        <div class="more_info_div" style="" ><span>+</span></div>
    </div>
    <div class="col hvr-grow">
        <div class="title_div"><span><h2>Web Design</h2></span></div>
        <img src="ClientBundle/ressources/folder_page/img/service-img1.jpg" />
        <table id="vertical-1">
            <tr>
                <th>Titre :</th>
                <td>La rose des ventsLa rose des ventsLa rose des vents</td>
            </tr>
            <tr>
                <th>Sous-titre :</th>
                <td>Fast and furious</td>
            </tr>
            <tr>
                <th>Descriptif :</th>
                <td>film de voiture</td>
            </tr>
            <tr>
                <th>Auteur :</th>
                <td>jenesaispas</td>
            </tr>
        </table>

        <div class="clear_div"></div>
        <div class="more_info_div" style="" ><span>+</span></div>
    </div>

    <div class="col hvr-grow">
        <div class="title_div"><span><h2>Web Development</h2></span></div>
        <img src="ClientBundle/ressources/folder_page/img/service-img2.jpg" />
        <table id="vertical-1">
            <tr>
                <th>Titre :</th>
                <td>La rose des ventsLa rose des ventsLa rose des vents</td>
            </tr>
            <tr>
                <th>Sous-titre :</th>
                <td>Fast and furious</td>
            </tr>
            <tr>
                <th>Descriptif :</th>
                <td>film de voiture</td>
            </tr>
            <tr>
                <th>Auteur :</th>
                <td>jenesaispas</td>
            </tr>
        </table>

        <div class="clear_div"></div>
        <div class="more_info_div" style="" ><span>+</span></div>
    </div>

    <div class="col hvr-grow">
        <div class="title_div"><span><h2>SEO</h2></span></div>
        <img src="ClientBundle/ressources/folder_page/img/service-img3.jpg" />
        <table id="vertical-1">
            <tr>
                <th>Titre :</th>
                <td>La rose des ventsLa rose des ventsLa rose des vents</td>
            </tr>
            <tr>
                <th>Sous-titre :</th>
                <td>Fast and furious</td>
            </tr>
            <tr>
                <th>Descriptif :</th>
                <td>film de voiture</td>
            </tr>
            <tr>
                <th>Auteur :</th>
                <td>jenesaispas</td>
            </tr>
        </table>

        <div class="clear_div"></div>
        <div class="more_info_div" style="" ><span>+</span></div>
    </div>

    <div class="col hvr-grow">
        <div class="title_div"><span><h2>Graphics Design</h2></span></div>
        <img src="ClientBundle/ressources/folder_page/img/service-img4.jpg" />
        <table id="vertical-1">
            <tr>
                <th>Titre :</th>
                <td>La rose des ventsLa rose des ventsLa rose des vents</td>
            </tr>
            <tr>
                <th>Sous-titre :</th>
                <td>Fast and furious</td>
            </tr>
            <tr>
                <th>Descriptif :</th>
                <td>film de voiture</td>
            </tr>
            <tr>
                <th>Auteur :</th>
                <td>jenesaispas</td>
            </tr>
        </table>

        <div class="clear_div"></div>
        <div class="more_info_div" style="" ><span>+</span></div>
    </div>

</div>

<?php

require_once('ClientBundle/views/layout/footer.php');

?>
