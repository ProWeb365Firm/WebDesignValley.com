<?php
/**
 * Contact form handler for the static Web Design Valley site.
 * Replaces Contact Form 7 (which needed WordPress). Uses PHP mail().
 * The same form appears on 7 pages; all of them post here.
 */

$to       = 'info@webdesignvalley.com';
$fromAddr = 'no-reply@webdesignvalley.com';

$allowedReturns = ['./', 'contact-us/', 'about-us/', 'local-seo/', 'digital-marketing/', 'website-design/', 'services/'];
$return = in_array($_POST['_return'] ?? '', $allowedReturns, true) ? $_POST['_return'] : './';
function back($return, $ok) { header('Location: ' . $return . '?sent=' . ($ok ? '1' : '0')); exit; }

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: ./'); exit; }

// Honeypot: real visitors never fill this hidden field.
if (!empty($_POST['website_url'])) back($return, true);

function clean_line($v) { return trim(str_replace(["\r", "\n", "%0a", "%0d"], ' ', (string)$v)); }

$name    = clean_line($_POST['your-name'] ?? '');
$email   = clean_line($_POST['your-email'] ?? '');
$phone   = clean_line($_POST['your-phone'] ?? '');
$message = trim((string)($_POST['your-message'] ?? ''));

if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) back($return, false);

$page = $return === './' ? 'Home' : rtrim($return, '/');
$body  = "New message from the website ({$page} page)\n\n";
$body .= "Name: {$name}\nEmail: {$email}\nPhone: {$phone}\n\nMessage:\n{$message}\n";
$body .= "\n--\nSent from webdesignvalley.com";

$headers  = "From: Web Design Valley Website <{$fromAddr}>\r\n";
$headers .= "Reply-To: {$name} <{$email}>\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

$ok = mail($to, 'Website message from ' . $name, $body, $headers, '-f' . $fromAddr);
back($return, $ok);
