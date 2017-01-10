<?php namespace App\Models\Traits;

use App\Publish;
use Carbon\Carbon;

trait PublishableTrait {

    /**
     *
     */
    public function publish()
    {
        return $this->belongsTo(Publish::class, 'publish_id');
    }

    public function getPublishDate()
    {
        if ($this->is_publish) {
            $date = $this->publish_at;
            return is_null($date) ? null : new Carbon($date);
        }

        return null;
    }

    public function isPublish()
    {
        return $this->publish ? $this->publish->is_publish : null;
    }

    public function getIsPublishAttribute()
    {
        return $this->isPublish();
    }

    public function associatePublish(Publish $publish, $date )
    {
        $this->publish()->associate($publish);
        $this->publish_at = $date;

        return $this->save();
    }

    public function updatePublish(Publish $publish, $date)
    {
        $this->publish()->dissociate();
        $this->publish_at = $date;

        return $this->associatePublish($publish);
    }

    public function updatePublishById($publish_id, $date)
    {
        $publish = Publish::find($publish_id);

        return $publish ? $this->updatePublish($publish, $date) : false;
    }

    public function publicate()
    {
        $publish = Publish::getPublish();
        return $this->associatePublish($publish, Carbon::now());
    }

    public function draft()
    {
        $not_publish = Publish::getNotPublish();
        return $this->associatePublish($not_publish, null);
    }

    public function scopePublished($query)
    {
        // dd(date('Y-m-d H:m:s'));
        return $query->with('publish')
        ->whereHas('publish', function($q){
            $q->onlyPublished();
        })
        // ->where('publish_at', '<=', Carbon::now()->format('Y-m-d H:m:s') )
        ;

    }

    public function scopeDraft($query)
    {
        return $query->with('publish')->whereHas('publish', function($q){
            $q->notPublished();
        });
    }



}
