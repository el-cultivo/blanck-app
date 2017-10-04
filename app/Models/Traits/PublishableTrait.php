<?php 

namespace App\Models\Traits;

use Carbon\Carbon;
use App\Models\Publish;

trait PublishableTrait 
{
    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function publish()
    {
        return $this->belongsTo(Publish::class, 'publish_id');
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function getIsPublishAttribute()
    {
        if ($this->publish) {
            $ahora = Carbon::now();
            $publish_date = Carbon::parse($this->publish_at);
            return $this->publish->is_publish && $ahora->gte($publish_date);
        }

        return false;
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function associatePublish(Publish $publish, $date )
    {
        $this->publish()->associate($publish);
        $this->publish_at = $date;

        return $this->save();
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function updatePublish(Publish $publish, $date)
    {
        $this->publish()->dissociate();
        $this->publish_at = $date;

        return $this->associatePublish($publish);
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function updatePublishById($publish_id, $date)
    {
        $publish = Publish::find($publish_id);

        return $publish ? $this->updatePublish($publish, $date) : false;
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function publicate()
    {
        $publish = Publish::getPublish();
        return $this->associatePublish($publish, Carbon::now());
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function draft()
    {
        $not_publish = Publish::getNotPublish();
        return $this->associatePublish($not_publish, null);
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function scopePublished($query)
    {
        return $query->with('publish')->whereDate('publish_at', '<=', Carbon::now())->whereHas('publish', function($q){
            $q->onlyPublished();
        });
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function scopeDraft($query)
    {
        return $query->with('publish')->whereHas('publish', function($q){
            $q->notPublished();
        });
    }
}
