<?php
include "items.php";
?>
<nav class="navbar">
    <div class="navbar-container">
        <a href="#" class="navbar-brand">
            Klinik Bidan
        </a>

        <div class="navbar-toggle" onclick="toggleMenu()">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>

        <ul class="navbar-menu">
            <li class="dropdown">
                <a class="dropdown-toggle">Data</a>
                <div class="dropdown-menu">
                    <a href="data_peserta.php">Data Peserta</a>
                    <a href="data_poli.php">Data Poli</a>
                    <a href="data_bidan.php">Data Bidan</a>
                    <a href="data_rekammedis.php">Data Rekam Medis</a>
                </div>
            </li>
            <!-- <li class="dropdown">
                <a class="dropdown-toggle">Laporan</a>
                <div class="dropdown-menu">
                    <a href="laporan.php">Laporan Umum</a>
                    <a href="laporanbidan.php">Laporan Bidan</a>
                    <a href="data_peserta.php">Laporan Peserta</a>
                    <a href="data_poli.php">Laporan Poli</a>
                    <a href="list_berobat.php">Laporan Rekam Medis</a>
                </div>
            </li> -->
        </ul>
    </div>
</nav>
<br>
<br>
<br>


