<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory,
        SoftDeletes,
        InteractsWithMedia;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'price',
        'order_by',
        'status'
    ];

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function stocks(): HasMany
    {
        return $this->hasMany(Stock::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')
            ->singleFile();

        $this->addMediaCollection('gallery');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bids(): HasMany
    {
        return $this->hasMany(Bid::class);
    }

    /**
     * Register media conversions for a given media.
     *
     * @param Media|null $media The media object to register conversions for.
     * @return void
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('250x250')
            ->width(250)
            ->height(250);

        $this->addMediaConversion('500x500')
            ->width(500)
            ->height(500);
    }


    public function toArray()
    {
        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'price' => $this->price,
            'order_by' => $this->order_by,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'category' => $this->category,
            'stocks' => $this->stocks,
            'reviews' => $this->reviews,
            'bids' => $this->bids,
            'featured_image' => $this->getFirstMediaUrl('featured_image'),
            'gallery' => $this->getMedia('gallery'),
        ];
    }


}
