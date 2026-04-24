<?php

namespace App\Helpers;

/**
 * Convert bytes to human-readable file size
 *
 * @param int $bytes
 * @return string
 */
function formatFileSize($bytes)
{
  $units = ['B', 'KB', 'MB', 'GB', 'TB'];
  $bytes = max($bytes, 0);
  $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
  $pow = min($pow, count($units) - 1);
  $bytes /= (1 << (10 * $pow));

  return round($bytes, 2) . ' ' . $units[$pow];
}

/**
 * Get file extension from mime type
 *
 * @param string $mimeType
 * @return string
 */
function getFileExtensionFromMime($mimeType)
{
  $mimes = [
    'application/pdf' => 'pdf',
    'application/msword' => 'doc',
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
    'application/vnd.ms-excel' => 'xls',
    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx',
    'text/csv' => 'csv',
    'text/plain' => 'txt',
  ];

  return $mimes[$mimeType] ?? 'file';
}

/**
 * Get Font Awesome icon class based on file mime type
 *
 * @param string $mimeType
 * @return string
 */
function getFileIcon($mimeType)
{
  $icons = [
    'application/pdf' => 'fa-file-pdf',
    'application/msword' => 'fa-file-word',
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'fa-file-word',
    'application/vnd.ms-excel' => 'fa-file-excel',
    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'fa-file-excel',
    'text/csv' => 'fa-file-csv',
    'text/plain' => 'fa-file-lines',
    'image/jpeg' => 'fa-file-image',
    'image/png' => 'fa-file-image',
  ];

  return $icons[$mimeType] ?? 'fa-file';
}
