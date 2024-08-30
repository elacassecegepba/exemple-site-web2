<?php

function telechargerFichier($cheminFichier, $nomFichier)
{
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename="' . $nomFichier . '"');
	header('Expires: 0');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	header('Content-Length: ' . filesize($cheminFichier));
	readfile($cheminFichier);
}