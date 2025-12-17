<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // BsStateMasterSeeder::class,            
            // BsDistrictMasterSeeder::class,
            // BsSubdivsionMasterSeeder::class,
            // BsCircleMasterSeeder::class,
            // BsBlockMuncCorpMasterSeeder::class,
            // BsClusterMasterSeeder::class,
            // BsCityMasterSeeder::class,
            // BsAssemblyMasterSeeder::class,
            // BsAwcProjectMasterSeeder::class,
            // BsAwcSectorMasterSeeder::class,
            // BsBankMasterSeeder::class,
            // BsBloodGroupMasterSeeder::class,
            // BsBoardCouncilMasterSeeder::class,
            // BsBoundaryWallTypeMasterSeeder::class,
            // BsCategoryMasterSeeder::class,
            // BsChildMainstreamedMasterSeeder::class,
            // BsClassMasterSeeder::class,
            // BsClassSectionMaster::class,
            // BsComputerLabMasterSeeder::class,
            // BsComputerLabModelMasterSeeder::class,
            // BsConductsTrainingMasterSeeder::class,
            // BsConductsTrainingPlaceMasterSeeder::class,
            // BsConductsTrainingTypeMasterSeeder::class,
            // BsCountryMasterSeeder::class,
            // BsCurrAcdYearSchoolStatusMasterSeeder::class,
            // BsCurriculumFollowedMasterSeeder::class,
            // BsDataPublishingCodeMasterSeeder::class,
            // BsDigitalDevicesIncMasterSeeder::class,
            // BsDiningHallConditionMasterSeeder::class,
            // BsDiningHallFundMasterSeeder::class,
            // BsDiningHallStatusMasterSeeder::class,
            // BsDongleReasonMasterSeeder::class,
            // BsDropStudentReasonMasterSeeder::class,
            // BsElearningMasterSeeder::class,
            // BsEmpPlacementStatusMasterSeeder::class,
            // BsExamNameMasterSeeder::class,
            // BsExerciseBookCategoryMasterSeeder::class,
            // BsFacilitiesCwsnMasterSeeder::class,
            // BsGenderMasterSeeder::class,
            // BsGsWardMasterSeeder_part1::class,
            // BsGsWardMasterSeeder_part2::class,
            // BsGsWardMasterSeeder_part3::class,
            // BsGsWardMasterSeeder_part4::class,
            // BsGsWardMasterSeeder_part5::class,
            // BsGsWardMasterSeeder_part6::class,
            // BsGsWardMasterSeeder_part7::class,
            // BsGsWardMasterSeeder_part8::class,
            // BsGsWardMasterSeeder_part9::class,
            // BsGsWardMasterSeeder_part10::class,
            // BsGsWardMasterSeeder_part11::class,
            // BsGsWardMasterSeeder_part12::class,
            // BsHomelessChildMasterSeeder::class,
            // BsHostelSchemesMasterSeeder::class,
            // BsHostelTypeMasterSeeder::class,
            // BsIncomeMasterSeeder::class,
            // BsIndustryOrTrainingExperienceMasterSeeder::class,
            // BsIssueCategoryMasterSeeder::class,
            // BsIssueTicketStatusMasterSeeder::class,
            // BsLocationTypeMasterSeeder::class,
            // BsLpgFundMasterSeeder::class,
            // BsManagementMasterSeeder::class,
            // BsMaritalStatusMasterSeeder::class,
            // BsMarksRangeMasterSeeder::class,
            // BsMediumMasterSeeder::class,
            
            // BsSchoolCategoryTypeMasterSeeder::class,
            // BsShoeSizeMasterSeeder::class,
            // BsSocialCategoryMasterSeeder::class,
            // BsSpecialEducatorMasterSeeder::class,
            // BsSpecialTrainingFacilityMasterSeeder::class,
            // BsStreamMasterSeeder::class,
            // BsStuAppearedMasterSeeder::class,
            // BsStuDisabilityTypeMasterSeeder::class,
            // BsReligionMasterSeeder::class,
            // BsMotherTongueSeeder::class,
            // BsGuardianQualificationMasterSeeder::class,
            // BsNationalityMasterSeeder::class,
            // BsPreviousSchoolingTypeMasterSeeder::class,
            // BsAdmissionTypeMasterSeeder::class,
            // BsManagementAndSchoolCategoryTypeMappingMasterSeeder::class,
            // BsNameAndCodeStateScholershipsMaster::class,
            // BsNameAndCodeCentralScholershipsMaster::class,
            // BsVocationalTradeSectorMaster::class,
            // BsVocationalJobRoleMaster::class,
            BankCodeNameMasterSeeder::class,
            BsReasonMasterNotTransferredInMasterSeeder::class,




        ]);
    }
}
