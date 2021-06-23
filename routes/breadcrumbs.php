<?php

namespace App\Models;

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dasbor
Breadcrumbs::for('admin.dashboard', function (BreadcrumbTrail $trail) {
	$trail->push('Dasbor', route('admin.dashboard'));
});

// Profil Saya
Breadcrumbs::for('admin.profile', function (BreadcrumbTrail $trail) {
	$trail->push('Profil Saya', route('admin.profile'));
});

// Data Dosen
Breadcrumbs::for('admin.teachers.index', function (BreadcrumbTrail $trail) {
	$trail->push('Data Dosen', route('admin.teachers.index'));
});
// Data Dosen > Tambah Data
Breadcrumbs::for('admin.teachers.create', function (BreadcrumbTrail $trail) {
	$trail->parent('admin.teachers.index');
	$trail->push('Tambah Data', route('admin.teachers.create'));
});
// Data Dosen > Edit Data
Breadcrumbs::for('admin.teachers.edit', function (BreadcrumbTrail $trail, Teacher $teacher) {
	$trail->parent('admin.teachers.index');
	$trail->push('Edit Data', route('admin.teachers.edit', $teacher));
});

// Data Bidang Usaha
Breadcrumbs::for('admin.business-fields.index', function (BreadcrumbTrail $trail) {
	$trail->push('Data Bidang Usaha', route('admin.business-fields.index'));
});
// Data Bidang Usaha > Tambah Data
Breadcrumbs::for('admin.business-fields.create', function (BreadcrumbTrail $trail) {
	$trail->parent('admin.business-fields.index');
	$trail->push('Tambah Data', route('admin.business-fields.create'));
});
// Data Bidang Usaha > Edit Data
Breadcrumbs::for('admin.business-fields.edit', function (BreadcrumbTrail $trail, BusinessField $businessField) {
	$trail->parent('admin.business-fields.index');
	$trail->push('Edit Data', route('admin.business-fields.edit', $businessField));
});

// Data Bidang Usaha > Data Jenis Usaha
Breadcrumbs::for('admin.business-fields.business-types.index', function (BreadcrumbTrail $trail, BusinessField $businessField) {
	$trail->parent('admin.business-fields.index');
	$trail->push('Data Jenis Usaha', route('admin.business-fields.business-types.index', $businessField));
});
// Data Bidang Usaha > Data Jenis Usaha > Tambah Data
Breadcrumbs::for('admin.business-fields.business-types.create', function (BreadcrumbTrail $trail, BusinessField $businessField) {
	$trail->parent('admin.business-fields.business-types.index', $businessField);
	$trail->push('Tambah Data', route('admin.business-fields.business-types.create', $businessField));
});
// Data Bidang Usaha > Data Jenis Usaha > Edit Data
Breadcrumbs::for('admin.business-types.edit', function (BreadcrumbTrail $trail, BusinessType $businessType) {
	$trail->parent('admin.business-fields.business-types.index', $businessType->businessField);
	$trail->push('Edit Data', route('admin.business-types.edit', $businessType));
});
