<?php

require_once __DIR__ . '/../repositories/MySQLActivityRepository.php';


class ActivityService {
    private $activityRepository;

    public function __construct($activityRepository) {
        $this->activityRepository = $activityRepository;
    }

    public function createActivity($activityData) {
        return $this->activityRepository->createActivity($activityData);
    }

    public function getActivityByCardId($cardId)
    {
        return $this->activityRepository->getActivityByCardId($cardId);
    }
}