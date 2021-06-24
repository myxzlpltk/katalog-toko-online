<?php

namespace App\Models;

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dasbor
Breadcrumbs::for('console.dashboard', function (BreadcrumbTrail $trail) {
	$trail->push('Dasbor', route('console.dashboard'));
});

// Profil Saya
Breadcrumbs::for('console.profile', function (BreadcrumbTrail $trail) {
	$trail->push('Profil Saya', route('console.profile'));
});

// Data Usaha
Breadcrumbs::for('console.businesses.index', function (BreadcrumbTrail $trail) {
	$trail->push('Data Usaha', route('console.businesses.index'));
});
// Data Usaha > Tambah Data
Breadcrumbs::for('console.businesses.create', function (BreadcrumbTrail $trail) {
	$trail->parent('console.businesses.index');
	$trail->push('Tambah Data', route('console.businesses.create'));
});
// Data Usaha > [Usaha]
Breadcrumbs::for('console.businesses.show', function (BreadcrumbTrail $trail, Business $business) {
	if(!request()->user()->is_student){
		$trail->parent('console.businesses.index');
	}
	$trail->push($business->name, route('console.businesses.show', $business));
});
// Data Usaha > [Usaha] > Edit Data
Breadcrumbs::for('console.businesses.edit', function (BreadcrumbTrail $trail, Business $business) {
	$trail->parent('console.businesses.show', $business);
	$trail->push('Edit Data', route('console.businesses.edit', $business));
});
// Data Usaha > [Usaha] > Terima Undangan
Breadcrumbs::for('console.businesses.invite', function (BreadcrumbTrail $trail, Business $business) {
	$trail->parent('console.businesses.show', $business);
	$trail->push('Terima Undangan', route('console.businesses.invite', $business));
});

// Data Usaha > [Usaha] > Data Feed Plan
Breadcrumbs::for('console.businesses.feed-plans.index', function (BreadcrumbTrail $trail, Business $business) {
	$trail->parent('console.businesses.show', $business);
	$trail->push('Data Feed Plan', route('console.businesses.feed-plans.index', $business));
});
// Data Usaha > [Usaha] > Data Feed Plan > Tambah Data
Breadcrumbs::for('console.businesses.feed-plans.create', function (BreadcrumbTrail $trail, Business $business) {
	$trail->parent('console.businesses.feed-plans.index', $business);
	$trail->push('Tambah Data', route('console.businesses.feed-plans.create', $business));
});
// Data Usaha > [Usaha] > Data Feed Plan > Feed Plan Ke-[feed_index]
Breadcrumbs::for('console.feed-plans.show', function (BreadcrumbTrail $trail, FeedPlan $feedPlan) {
	$trail->parent('console.businesses.feed-plans.index', $feedPlan->business);
	$trail->push("Feed Plan Ke-{$feedPlan->feed_index}", route('console.feed-plans.show', $feedPlan));
});
// Data Usaha > [Usaha] > Data Feed Plan > Feed Plan Ke-[feed_index] > Edit Data
Breadcrumbs::for('console.feed-plans.edit', function (BreadcrumbTrail $trail, FeedPlan $feedPlan) {
	$trail->parent('console.feed-plans.show', $feedPlan);
	$trail->push('Edit Data', route('console.feed-plans.edit', $feedPlan));
});
// Data Usaha > [Usaha] > Data Feed Plan > Feed Plan Ke-[feed_index] > Tambah Desain
Breadcrumbs::for('console.feed-plans.feed-plan-designs.create', function (BreadcrumbTrail $trail, FeedPlan $feedPlan) {
	$trail->parent('console.feed-plans.show', $feedPlan);
	$trail->push('Tambah Desain', route('console.feed-plans.feed-plan-designs.create', $feedPlan));
});


// Data Dosen
Breadcrumbs::for('console.teachers.index', function (BreadcrumbTrail $trail) {
	$trail->push('Data Dosen', route('console.teachers.index'));
});
// Data Dosen > Tambah Data
Breadcrumbs::for('console.teachers.create', function (BreadcrumbTrail $trail) {
	$trail->parent('console.teachers.index');
	$trail->push('Tambah Data', route('console.teachers.create'));
});
// Data Dosen > Edit Data
Breadcrumbs::for('console.teachers.edit', function (BreadcrumbTrail $trail, Teacher $teacher) {
	$trail->parent('console.teachers.index');
	$trail->push('Edit Data', route('console.teachers.edit', $teacher));
});

// Data Bidang Usaha
Breadcrumbs::for('console.business-fields.index', function (BreadcrumbTrail $trail) {
	$trail->push('Data Bidang Usaha', route('console.business-fields.index'));
});
// Data Bidang Usaha > Tambah Data
Breadcrumbs::for('console.business-fields.create', function (BreadcrumbTrail $trail) {
	$trail->parent('console.business-fields.index');
	$trail->push('Tambah Data', route('console.business-fields.create'));
});
// Data Bidang Usaha > Edit Data
Breadcrumbs::for('console.business-fields.edit', function (BreadcrumbTrail $trail, BusinessField $businessField) {
	$trail->parent('console.business-fields.index');
	$trail->push('Edit Data', route('console.business-fields.edit', $businessField));
});

// Data Bidang Usaha > Data Jenis Usaha
Breadcrumbs::for('console.business-fields.business-types.index', function (BreadcrumbTrail $trail, BusinessField $businessField) {
	$trail->parent('console.business-fields.index');
	$trail->push('Data Jenis Usaha', route('console.business-fields.business-types.index', $businessField));
});
// Data Bidang Usaha > Data Jenis Usaha > Tambah Data
Breadcrumbs::for('console.business-fields.business-types.create', function (BreadcrumbTrail $trail, BusinessField $businessField) {
	$trail->parent('console.business-fields.business-types.index', $businessField);
	$trail->push('Tambah Data', route('console.business-fields.business-types.create', $businessField));
});
// Data Bidang Usaha > Data Jenis Usaha > Edit Data
Breadcrumbs::for('console.business-types.edit', function (BreadcrumbTrail $trail, BusinessType $businessType) {
	$trail->parent('console.business-fields.business-types.index', $businessType->businessField);
	$trail->push('Edit Data', route('console.business-types.edit', $businessType));
});
