<?php

/**
 * A helper file for Dcat Admin, to provide autocomplete information to your IDE
 *
 * This file should not be included in your code, only analyzed by your IDE!
 *
 * @author jqh <841324345@qq.com>
 */
namespace Dcat\Admin {
    use Illuminate\Support\Collection;

    /**
     * @property Grid\Column|Collection order
     * @property Grid\Column|Collection parent_id
     * @property Grid\Column|Collection tags
     * @property Grid\Column|Collection id
     * @property Grid\Column|Collection name
     * @property Grid\Column|Collection type
     * @property Grid\Column|Collection version
     * @property Grid\Column|Collection detail
     * @property Grid\Column|Collection created_at
     * @property Grid\Column|Collection updated_at
     * @property Grid\Column|Collection is_enabled
     * @property Grid\Column|Collection icon
     * @property Grid\Column|Collection uri
     * @property Grid\Column|Collection extension
     * @property Grid\Column|Collection permission_id
     * @property Grid\Column|Collection menu_id
     * @property Grid\Column|Collection slug
     * @property Grid\Column|Collection http_method
     * @property Grid\Column|Collection http_path
     * @property Grid\Column|Collection role_id
     * @property Grid\Column|Collection user_id
     * @property Grid\Column|Collection value
     * @property Grid\Column|Collection username
     * @property Grid\Column|Collection password
     * @property Grid\Column|Collection avatar
     * @property Grid\Column|Collection remember_token
     * @property Grid\Column|Collection uuid
     * @property Grid\Column|Collection connection
     * @property Grid\Column|Collection queue
     * @property Grid\Column|Collection payload
     * @property Grid\Column|Collection exception
     * @property Grid\Column|Collection failed_at
     * @property Grid\Column|Collection news_category_id
     * @property Grid\Column|Collection banner_url
     * @property Grid\Column|Collection excerpt
     * @property Grid\Column|Collection content
     * @property Grid\Column|Collection read_count
     * @property Grid\Column|Collection is_recommend
     * @property Grid\Column|Collection status
     * @property Grid\Column|Collection sort_order
     * @property Grid\Column|Collection news_id
     * @property Grid\Column|Collection news_tag_id
     * @property Grid\Column|Collection seo_title
     * @property Grid\Column|Collection seo_keywords
     * @property Grid\Column|Collection seo_description
     * @property Grid\Column|Collection permalink
     * @property Grid\Column|Collection email
     * @property Grid\Column|Collection token
     * @property Grid\Column|Collection tokenable_type
     * @property Grid\Column|Collection tokenable_id
     * @property Grid\Column|Collection abilities
     * @property Grid\Column|Collection last_used_at
     * @property Grid\Column|Collection image_url
     * @property Grid\Column|Collection has_button
     * @property Grid\Column|Collection button_link_url
     * @property Grid\Column|Collection is_light
     * @property Grid\Column|Collection position
     * @property Grid\Column|Collection mobile
     * @property Grid\Column|Collection email_verified_at
     * @property Grid\Column|Collection gender
     * @property Grid\Column|Collection birthdate
     * @property Grid\Column|Collection address
     * @property Grid\Column|Collection wx_nickname
     * @property Grid\Column|Collection wx_avatar
     * @property Grid\Column|Collection wx_openid
     * @property Grid\Column|Collection xcx_openid
     * @property Grid\Column|Collection unionid
     * @property Grid\Column|Collection oauth_scope
     * @property Grid\Column|Collection nickname
     * @property Grid\Column|Collection birth
     *
     * @method Grid\Column|Collection order(string $label = null)
     * @method Grid\Column|Collection parent_id(string $label = null)
     * @method Grid\Column|Collection tags(string $label = null)
     * @method Grid\Column|Collection id(string $label = null)
     * @method Grid\Column|Collection name(string $label = null)
     * @method Grid\Column|Collection type(string $label = null)
     * @method Grid\Column|Collection version(string $label = null)
     * @method Grid\Column|Collection detail(string $label = null)
     * @method Grid\Column|Collection created_at(string $label = null)
     * @method Grid\Column|Collection updated_at(string $label = null)
     * @method Grid\Column|Collection is_enabled(string $label = null)
     * @method Grid\Column|Collection icon(string $label = null)
     * @method Grid\Column|Collection uri(string $label = null)
     * @method Grid\Column|Collection extension(string $label = null)
     * @method Grid\Column|Collection permission_id(string $label = null)
     * @method Grid\Column|Collection menu_id(string $label = null)
     * @method Grid\Column|Collection slug(string $label = null)
     * @method Grid\Column|Collection http_method(string $label = null)
     * @method Grid\Column|Collection http_path(string $label = null)
     * @method Grid\Column|Collection role_id(string $label = null)
     * @method Grid\Column|Collection user_id(string $label = null)
     * @method Grid\Column|Collection value(string $label = null)
     * @method Grid\Column|Collection username(string $label = null)
     * @method Grid\Column|Collection password(string $label = null)
     * @method Grid\Column|Collection avatar(string $label = null)
     * @method Grid\Column|Collection remember_token(string $label = null)
     * @method Grid\Column|Collection uuid(string $label = null)
     * @method Grid\Column|Collection connection(string $label = null)
     * @method Grid\Column|Collection queue(string $label = null)
     * @method Grid\Column|Collection payload(string $label = null)
     * @method Grid\Column|Collection exception(string $label = null)
     * @method Grid\Column|Collection failed_at(string $label = null)
     * @method Grid\Column|Collection news_category_id(string $label = null)
     * @method Grid\Column|Collection banner_url(string $label = null)
     * @method Grid\Column|Collection excerpt(string $label = null)
     * @method Grid\Column|Collection content(string $label = null)
     * @method Grid\Column|Collection read_count(string $label = null)
     * @method Grid\Column|Collection is_recommend(string $label = null)
     * @method Grid\Column|Collection status(string $label = null)
     * @method Grid\Column|Collection sort_order(string $label = null)
     * @method Grid\Column|Collection news_id(string $label = null)
     * @method Grid\Column|Collection news_tag_id(string $label = null)
     * @method Grid\Column|Collection seo_title(string $label = null)
     * @method Grid\Column|Collection seo_keywords(string $label = null)
     * @method Grid\Column|Collection seo_description(string $label = null)
     * @method Grid\Column|Collection permalink(string $label = null)
     * @method Grid\Column|Collection email(string $label = null)
     * @method Grid\Column|Collection token(string $label = null)
     * @method Grid\Column|Collection tokenable_type(string $label = null)
     * @method Grid\Column|Collection tokenable_id(string $label = null)
     * @method Grid\Column|Collection abilities(string $label = null)
     * @method Grid\Column|Collection last_used_at(string $label = null)
     * @method Grid\Column|Collection image_url(string $label = null)
     * @method Grid\Column|Collection has_button(string $label = null)
     * @method Grid\Column|Collection button_link_url(string $label = null)
     * @method Grid\Column|Collection is_light(string $label = null)
     * @method Grid\Column|Collection position(string $label = null)
     * @method Grid\Column|Collection mobile(string $label = null)
     * @method Grid\Column|Collection email_verified_at(string $label = null)
     * @method Grid\Column|Collection gender(string $label = null)
     * @method Grid\Column|Collection birthdate(string $label = null)
     * @method Grid\Column|Collection address(string $label = null)
     * @method Grid\Column|Collection wx_nickname(string $label = null)
     * @method Grid\Column|Collection wx_avatar(string $label = null)
     * @method Grid\Column|Collection wx_openid(string $label = null)
     * @method Grid\Column|Collection xcx_openid(string $label = null)
     * @method Grid\Column|Collection unionid(string $label = null)
     * @method Grid\Column|Collection oauth_scope(string $label = null)
     * @method Grid\Column|Collection nickname(string $label = null)
     * @method Grid\Column|Collection birth(string $label = null)
     */
    class Grid {}

    class MiniGrid extends Grid {}

    /**
     * @property Show\Field|Collection order
     * @property Show\Field|Collection parent_id
     * @property Show\Field|Collection tags
     * @property Show\Field|Collection id
     * @property Show\Field|Collection name
     * @property Show\Field|Collection type
     * @property Show\Field|Collection version
     * @property Show\Field|Collection detail
     * @property Show\Field|Collection created_at
     * @property Show\Field|Collection updated_at
     * @property Show\Field|Collection is_enabled
     * @property Show\Field|Collection icon
     * @property Show\Field|Collection uri
     * @property Show\Field|Collection extension
     * @property Show\Field|Collection permission_id
     * @property Show\Field|Collection menu_id
     * @property Show\Field|Collection slug
     * @property Show\Field|Collection http_method
     * @property Show\Field|Collection http_path
     * @property Show\Field|Collection role_id
     * @property Show\Field|Collection user_id
     * @property Show\Field|Collection value
     * @property Show\Field|Collection username
     * @property Show\Field|Collection password
     * @property Show\Field|Collection avatar
     * @property Show\Field|Collection remember_token
     * @property Show\Field|Collection uuid
     * @property Show\Field|Collection connection
     * @property Show\Field|Collection queue
     * @property Show\Field|Collection payload
     * @property Show\Field|Collection exception
     * @property Show\Field|Collection failed_at
     * @property Show\Field|Collection news_category_id
     * @property Show\Field|Collection banner_url
     * @property Show\Field|Collection excerpt
     * @property Show\Field|Collection content
     * @property Show\Field|Collection read_count
     * @property Show\Field|Collection is_recommend
     * @property Show\Field|Collection status
     * @property Show\Field|Collection sort_order
     * @property Show\Field|Collection news_id
     * @property Show\Field|Collection news_tag_id
     * @property Show\Field|Collection seo_title
     * @property Show\Field|Collection seo_keywords
     * @property Show\Field|Collection seo_description
     * @property Show\Field|Collection permalink
     * @property Show\Field|Collection email
     * @property Show\Field|Collection token
     * @property Show\Field|Collection tokenable_type
     * @property Show\Field|Collection tokenable_id
     * @property Show\Field|Collection abilities
     * @property Show\Field|Collection last_used_at
     * @property Show\Field|Collection image_url
     * @property Show\Field|Collection has_button
     * @property Show\Field|Collection button_link_url
     * @property Show\Field|Collection is_light
     * @property Show\Field|Collection position
     * @property Show\Field|Collection mobile
     * @property Show\Field|Collection email_verified_at
     * @property Show\Field|Collection gender
     * @property Show\Field|Collection birthdate
     * @property Show\Field|Collection address
     * @property Show\Field|Collection wx_nickname
     * @property Show\Field|Collection wx_avatar
     * @property Show\Field|Collection wx_openid
     * @property Show\Field|Collection xcx_openid
     * @property Show\Field|Collection unionid
     * @property Show\Field|Collection oauth_scope
     * @property Show\Field|Collection nickname
     * @property Show\Field|Collection birth
     *
     * @method Show\Field|Collection order(string $label = null)
     * @method Show\Field|Collection parent_id(string $label = null)
     * @method Show\Field|Collection tags(string $label = null)
     * @method Show\Field|Collection id(string $label = null)
     * @method Show\Field|Collection name(string $label = null)
     * @method Show\Field|Collection type(string $label = null)
     * @method Show\Field|Collection version(string $label = null)
     * @method Show\Field|Collection detail(string $label = null)
     * @method Show\Field|Collection created_at(string $label = null)
     * @method Show\Field|Collection updated_at(string $label = null)
     * @method Show\Field|Collection is_enabled(string $label = null)
     * @method Show\Field|Collection icon(string $label = null)
     * @method Show\Field|Collection uri(string $label = null)
     * @method Show\Field|Collection extension(string $label = null)
     * @method Show\Field|Collection permission_id(string $label = null)
     * @method Show\Field|Collection menu_id(string $label = null)
     * @method Show\Field|Collection slug(string $label = null)
     * @method Show\Field|Collection http_method(string $label = null)
     * @method Show\Field|Collection http_path(string $label = null)
     * @method Show\Field|Collection role_id(string $label = null)
     * @method Show\Field|Collection user_id(string $label = null)
     * @method Show\Field|Collection value(string $label = null)
     * @method Show\Field|Collection username(string $label = null)
     * @method Show\Field|Collection password(string $label = null)
     * @method Show\Field|Collection avatar(string $label = null)
     * @method Show\Field|Collection remember_token(string $label = null)
     * @method Show\Field|Collection uuid(string $label = null)
     * @method Show\Field|Collection connection(string $label = null)
     * @method Show\Field|Collection queue(string $label = null)
     * @method Show\Field|Collection payload(string $label = null)
     * @method Show\Field|Collection exception(string $label = null)
     * @method Show\Field|Collection failed_at(string $label = null)
     * @method Show\Field|Collection news_category_id(string $label = null)
     * @method Show\Field|Collection banner_url(string $label = null)
     * @method Show\Field|Collection excerpt(string $label = null)
     * @method Show\Field|Collection content(string $label = null)
     * @method Show\Field|Collection read_count(string $label = null)
     * @method Show\Field|Collection is_recommend(string $label = null)
     * @method Show\Field|Collection status(string $label = null)
     * @method Show\Field|Collection sort_order(string $label = null)
     * @method Show\Field|Collection news_id(string $label = null)
     * @method Show\Field|Collection news_tag_id(string $label = null)
     * @method Show\Field|Collection seo_title(string $label = null)
     * @method Show\Field|Collection seo_keywords(string $label = null)
     * @method Show\Field|Collection seo_description(string $label = null)
     * @method Show\Field|Collection permalink(string $label = null)
     * @method Show\Field|Collection email(string $label = null)
     * @method Show\Field|Collection token(string $label = null)
     * @method Show\Field|Collection tokenable_type(string $label = null)
     * @method Show\Field|Collection tokenable_id(string $label = null)
     * @method Show\Field|Collection abilities(string $label = null)
     * @method Show\Field|Collection last_used_at(string $label = null)
     * @method Show\Field|Collection image_url(string $label = null)
     * @method Show\Field|Collection has_button(string $label = null)
     * @method Show\Field|Collection button_link_url(string $label = null)
     * @method Show\Field|Collection is_light(string $label = null)
     * @method Show\Field|Collection position(string $label = null)
     * @method Show\Field|Collection mobile(string $label = null)
     * @method Show\Field|Collection email_verified_at(string $label = null)
     * @method Show\Field|Collection gender(string $label = null)
     * @method Show\Field|Collection birthdate(string $label = null)
     * @method Show\Field|Collection address(string $label = null)
     * @method Show\Field|Collection wx_nickname(string $label = null)
     * @method Show\Field|Collection wx_avatar(string $label = null)
     * @method Show\Field|Collection wx_openid(string $label = null)
     * @method Show\Field|Collection xcx_openid(string $label = null)
     * @method Show\Field|Collection unionid(string $label = null)
     * @method Show\Field|Collection oauth_scope(string $label = null)
     * @method Show\Field|Collection nickname(string $label = null)
     * @method Show\Field|Collection birth(string $label = null)
     */
    class Show {}

    /**
     
     */
    class Form {}

}

namespace Dcat\Admin\Grid {
    /**
     
     */
    class Column {}

    /**
     
     */
    class Filter {}
}

namespace Dcat\Admin\Show {
    /**
     
     */
    class Field {}
}
