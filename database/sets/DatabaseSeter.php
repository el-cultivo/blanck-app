<?php

use App\Console\Cltvo\SetSite\CltvoSeter;

class DatabaseSeter extends CltvoSeter
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$this->call(PermissionSet::class);
        $this->call(RoleSet::class);
        $this->call(AssociatePermissionRoleSet::class);
        $this->call(FirstUserSet::class);
        $this->call(AdminsUserSet::class);
        $this->call(LanguageSet::class);
        $this->call(PhotoSet::class);
        $this->call(PublishSet::class);

        $this->call(PageSectionTypeSet::class);
        $this->call(PageSet::class);
		$this->call(PageSectionSet::class);
		$this->call(AssociatePageSectionPageSet::class);
        $this->call(CopySet::class);
        $this->call(ShapeSet::class);
    }
}
