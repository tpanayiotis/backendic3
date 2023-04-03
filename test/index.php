<?php
 
 header("Content-Type: application/json; charset=UTF-8");
 header("Access-Control-Allow-Origin: *"); 
 header("Access-Control-Allow-Headers: *");
 if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {    
     exit(0);
 } 
define('SECRETKEY',"Kcdp3ETZ5MD8,Q}jy(RdGsb1E8S(K3");
//autoloader function was included
include 'src/autoloader.php';
spl_autoload_register('autoloader');
//exceptionhandler function was included
include 'src/exceptionhandler.php';
set_exception_handler('exceptionHandler');

//Endpoint paths were coded here
$path =parse_url ( $_SERVER["REQUEST_URI"])['path'];
$path = str_replace("/ic3", "", $path); 

    switch($path) {
        case '/':
            
            $endpoint = new Base();
            break;
            case '/events':
                $endpoint = new Events();
                break;
            case '/education':
                $endpoint = new Education();
                break;
            case '/delete/':
                $endpoint = new Delete();
                break;
            case '/addevent':
                $endpoint = new AddEvent();
                break;
            case '/editeducation':
                $endpoint = new editeducation();
                break;
        case '/submissions':
            $endpoint = new Submissions();
            break;
            case '/about':
                $endpoint = new About();
                break;
                case '/people':
                    $endpoint = new People();
                    break;
                    case '/partners':
                        $endpoint = new Partners();
                        break;
                        case '/update':
                            $endpoint = new Update();
                            break;
                            case '/insertpeople':
                                $endpoint = new InsertPeople();
                                break;
                                case '/insertpartners':
                                    $endpoint = new InsertPartners();
                                    break;
                                    case '/deletepeople':
                                        $endpoint = new DeletePeople();
                                        break;
                                        case '/deletepartners':
                                            $endpoint = new DeletePartners();
                                            break;
                                            case '/inserttext':
                                                $endpoint = new InsertText();
                                                break;
                                                case '/activities':
                                                    $endpoint = new Activities();
                                                    break;
                                                    case '/activitiesimg':
                                                        $endpoint = new Activitiesimg();
                                                        break;
                                                    case '/projects':
                                                        $endpoint = new Projects();
                                                        break;
                                                        case '/projects_text':
                                                            $endpoint = new Projects_Text();
                                                            break;
                                                            case '/demonstrators_text':
                                                             $endpoint = new Demonstrators_Text();
                                                        break;
                                                        case '/demonstrators_projects':
                                                         $endpoint = new  Demonstrators_Projects();
                                                            break;
                                                        case'/updateprojectext':
                                                         $endpoint = new UpdateProjectText();
                                                         break;
                                                         case'/updatedemonstratorstext':
                                                              $endpoint = new UpdateText();
                                                                 break;
                                                            case'/insertprojecttext':
                                                             $endpoint = new InsertProjectText();
                                                              break;
                                                                 case'/demonstratorsprojecttext':
                                                                 $endpoint = new InsertDemonstratorsText();
                                                                  break;
                                                                      case'/deleteprojecttext':
                                                                         $endpoint = new DeleteProjectText();
                                                                              break;
                                                                              case'/insertproject':
                                                                                   $endpoint = new InsertProject();
                                                                                            break;
                                                                                            case'/updateproject':
                                                                                                $endpoint = new UpdateProject();
                                                                                                break;
                                                                                                case'/deleteproject':
                                                                                                    $endpoint = new DeleteProject();
                                                                                                    break;  
                                                                                                    case'/deletedemonstratorstext':
                                                                                                        $endpoint = new DeleteDemonstratorsText();
                                                                                                        break; 
                                                                                                        case'/insertdemonstratorsproject':
                                                                                                            $endpoint = new InsertDemonstratorsProject();
                                                                                                            break;
                                                                                                            case'/deletedemonstratorsproject':
                                                                                                                $endpoint = new DeleteDemonstratorsProject();
                                                                                                                break;     
                                                                                                                case'/updatedemonstratorsproject':
                                                                                                                    $endpoint = new UpdateDemonstratorsProject();
                                                                                                                    break;
                                                                                          
                                                                                                                    
                                                                                    case'/updateactivitiestext':
                                                                        $endpoint = new UpdateActivitiesText();
                                                                     break;
                                                                     case'/updateactivitiesimg':
                                                                        $endpoint = new UpdateActivitiesImg();
                                                                     break;
                                                                    case'/insertactivitiestext':
                                                                   $endpoint = new InsertActivitiesText();
                                                                    break;
                                                                    case'/deleteactivitiestext':
                                                                        $endpoint = new DeleteActivitiesText();
                                                                         break;
                                
                                
                                                                         case'/deleteinnovationtext':
                                                                            $endpoint = new DeleteInnovationText();
                                                                            break; 
                                                                            case'/insertinnovationproject':
                                                                                $endpoint = new InsertInnovationProject();
                                                                                break;
                                                                                case'/deleteinnovationproject':
                                                                                    $endpoint = new DeleteInnovationProject();
                                                                                    break;     
                                                                                    case'/updateinnovationproject':
                                                                                        $endpoint = new UpdateInnovationProject();
                                                                                        break;      
                                                                                        case '/innovation_text':
                                                                                            $endpoint = new Innovation_Text();
                                                                                       break;
                                                                                       case '/innovation_projects':
                                                                                        $endpoint = new  Innovation_Projects();
                                                                                           break;
                                                                                           case'/innovationprojecttext':
                                                                                            $endpoint = new InsertInnovationText();
                                                                                             break;
                                                                                             case'/updateinnovationtext':
                                                                                                $endpoint = new UpdateInnovationText();
                                                                                                   break;
                                                                                                        case'/dashboard':
                                                                                                            $endpoint = new dashboard();
                                                                                                               break;case'/auth':
                                                                                                                $endpoint = new Authenticate();
                                                                                                                   break;
      case '/api/resources/':
    case '/api/resources':
        $endpoint = new Resources($request, $response);
        break;
    case '/api/resources/category-text/':
    case '/api/resources/category-text':
        $endpoint = new CategoryText($request, $response);
        break;
    case '/api/resources/news-and-insights/':
    case '/api/resources/news-and-insights':
        $endpoint = new NewsAndInsights($request, $response);
        break;
    case '/api/resources/relevant-news-stories/':
    case '/api/resources/relevant-news-stories':
        $endpoint = new RelevantNewsStories($request, $response);
        break;
    case '/api/resources/industry-reports/':
    case '/api/resources/industry-reports':
        $endpoint = new IndustryReports($request, $response);
        break;
    case '/api/community&network/':
    case '/api/community&network':
        $endpoint = new CommunityNetwork($request, $response);
        break;
    case '/api/resources/category-text/add/':
    case '/api/resources/category-text/add':
        $endpoint = new CategoryTextAdd($request, $response);
        break;
    case '/api/resources/news-and-insights/add/':
    case '/api/resources/news-and-insights/add':
        $endpoint = new NewsAndInsightsAdd($request, $response);
        break;
    case '/api/resources/relevant-news-stories/add/':
    case '/api/resources/relevant-news-stories/add':
        $endpoint = new RelevantNewsStoriesAdd($request, $response);
        break;
    case '/api/resources/industry-reports/add/':
    case '/api/resources/industry-reports/add':
        $endpoint = new IndustryReportsAdd($request, $response);
        break;
    case '/api/community&network/add/':
    case '/api/community&network/add':
        $endpoint = new CommunityNetworkAdd($request, $response);
        break;
    case '/api/resources/category-text/delete/':
    case '/api/resources/category-text/delete':
        $endpoint = new CategoryTextDelete($request, $response);
        break;
    case '/api/resources/news-and-insights/delete/':
    case '/api/resources/news-and-insights/delete':
        $endpoint = new NewsAndInsightsDelete($request, $response);
        break;
    case '/api/resources/relevant-news-stories/delete/':
    case '/api/resources/relevant-news-stories/delete':
        $endpoint = new RelevantNewsStoriesDelete($request, $response);
        break;
    case '/api/resources/industry-reports/delete/':
    case '/api/resources/industry-reports/delete':
        $endpoint = new IndustryReportsDelete($request, $response);
        break;
    case '/api/community&network/delete/':
    case '/api/community&network/delete':
        $endpoint = new CommunityNetworkDelete($request, $response);
        break;
        default:
        $endpoint = new ClientError("Path not found: " . $path, 404);
          
    }

 
$response = $endpoint->getData();
echo json_encode($response);
