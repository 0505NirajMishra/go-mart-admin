<?php

namespace App\Services;

use App\Models\Notification;

class NotificationService
{
    /**
     * Update the specified resource in storage.
     *
     * @param  array $data
     * @return Notification
     */
    public static function create(array $data)
    {
        $data = Notification::create($data);
        $notification = [
            "noti_id" => $data->notification_id,
            "id" => $data->user_id,
            "notification" => [
                "title" => $data->notification_subject,
                "body" => $data->notification_message],
        ];

        $notification1 = HelperService::sendNotification($notification);
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Array $data - Updated Data
     * @param  Notification $notification
     * @return Notification
     */
    public static function update(array $data, Notification $notification)
    {
        $data = $notification->update($data);
        return $data;
    }

    /**
     * UpdateById the specified resource in storage.
     *
     * @param  Array $data - Updated Data
     * @param  $id
     * @return Notification
     */
    public static function updateById(array $data, $id)
    {
        $data = Notification::whereId($id)->update($data);
        return $data;
    }

    /**
     * Get Data By Id from storage.
     *
     * @param  Int $id
     * @return Notification
     */
    public static function getById($id)
    {
        $data = Notification::find($id);
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Notification
     * @return bool
     */
    public static function delete(Notification $notification)
    {
        $data = $notification->delete();
        return $data;
    }

    /**
     * RemoveById the specified resource from storage.
     *
     * @param  $id
     * @return bool
     */
    public static function deleteById($id)
    {
        $data = Notification::whereId($id)->delete();
        return $data;
    }

    /**
     * Get data for datatable from storage.
     *
     * @return Notification with states, countries
     */
    public static function datatable()
    {
        $data = Notification::orderBy('created_at', 'desc')->paginate(10);
        return $data;
    }
}
